<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class SubscriptionController extends Controller
{

    public function index()
    {
        $user = Auth::guard('customer')->user();

        // Get latest subscription for the user that is active or cancel_requested
        $subscription = Subscription::with('package')
            ->where('customer_id', $user->id)
            ->whereIn('status', ['active', 'cancel_requested'])
            ->orderByDesc('start_date')
            ->first();

        // Get all active packages
        $packages = Package::where('status', 'active')->get();

        // Determine if the subscription can be canceled
        $canCancel = false;
        $cancelDeadline = null;
        $cancelWindow = setting('cancel_subscription_days') ?? 0;

        if ($subscription && $subscription->status === 'active') {
            $cancelDeadline = Carbon::parse($subscription->start_date)->addDays($cancelWindow);
            $isUsed = $subscription->used_listings > 0;

            $canCancel = $cancelWindow > 0
                && now()->lte($cancelDeadline)
                && !$isUsed;
        }

        return view('user.subscriptions', compact(
            'subscription',
            'packages',
            'canCancel',
            'cancelDeadline',
            'cancelWindow',
        ));
    }


    public function SubscriptionPlans()
    {
        $user = Auth::guard('customer')->user();

        // get all active packages
        $packages = Package::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $walletBalance = 0;
        if ($user) {
            // Get wallet balance (default 0 if no wallet yet)
            $walletBalance = optional($user->wallet)->balance ?? 0;
        }

        return view('user.subscription-plan', compact('packages', 'walletBalance'));
    }


    public function ListPackage()
    {
        $user = Auth::guard('customer')->user();

        $packages = Package::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $walletBalance = $user ? optional($user->wallet)->balance ?? 0 : 0;

        $prefill = $user ? [
            'name' => $user->name,
            'email' => $user->email,
            'contact' => $user->mobile ?? ''
        ] : [
            'name' => '',
            'email' => '',
            'contact' => ''
        ];

        return view('front.pricing', compact('packages', 'walletBalance', 'prefill'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:razorpay,wallet',
            'razorpay_payment_id' => 'required_if:payment_method,razorpay'
        ]);

        $customer = Auth::guard('customer')->user();
        $activeSubscription = Subscription::where('customer_id', $customer->id)
            ->where('status', 'active')
            ->exists();

        if ($activeSubscription) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an active subscription.'
            ]);
        }

        DB::beginTransaction();

        try {
            $package = Package::findOrFail($request->package_id);


            // Wallet payment
            if ($request->payment_method === 'wallet') {
                $wallet = $customer->wallet;

                if (!$wallet || $wallet->balance < $package->offered_price) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Insufficient wallet balance.'
                    ]);
                }

                $wallet->addTransaction(
                    'debit',
                    $package->offered_price,
                    'Purchase Subscription',
                    "Purchased {$package->name} plan",
                    $package->id
                );
            }

            // Better order number
            $orderNumber = 'SUB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

            // Validity calculation
            $endDate = match ($package->validity_unit) {
                'days' => now()->addDays($package->validity),
                'weeks' => now()->addWeeks($package->validity),
                'months' => now()->addMonths($package->validity),
                'years' => now()->addYears($package->validity),
                default => now()->addDays(30),
            };

            $subscription = Subscription::create([
                'customer_id' => $customer->id,
                'package_id' => $package->id,
                'listings' => $package->listings,
                'used_listings' => 0,
                'start_date' => now(),
                'end_date' => $endDate,

                'sponsored' => $package->sponsored,
                'sponsored_frequency' => $package->sponsored_frequency,
                'sponsored_unit' => $package->sponsored_unit,

                'whatsapp' => $package->whatsapp,
                'whatsapp_frequency' => $package->whatsapp_frequency,
                'whatsapp_unit' => $package->whatsapp_unit,

                'featured' => $package->featured,
                'featured_frequency' => $package->featured_frequency,
                'featured_unit' => $package->featured_unit,

                'alerts' => $package->alerts,
                'order_number' => $orderNumber,
                'status' => 'active',
            ]);

            Payment::create([
                'subscription_id' => $subscription->id,
                'gateway' => $request->payment_method,
                'payment_id' => $request->payment_method === 'razorpay'
                    ? $request->razorpay_payment_id
                    : 'WALLET-' . strtoupper(uniqid()),
                'amount' => $package->offered_price,
                'currency' => 'INR',
                'status' => 'success'
            ]);

            $invoiceNumber = $this->generateUniqueInvoiceNumber();

            Invoice::create([
                'subscription_id' => $subscription->id,
                'invoice_number' => $invoiceNumber,
                'amount' => $package->offered_price,
                'currency' => 'INR',
                'issued_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'order_number' => $orderNumber,
                'invoice_number' => $invoiceNumber
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Subscription failed. Please try again.'
            ], 500);
        }
    }



    public function renew(Request $request)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);
        $package = $subscription->package;

        $subscription->start_date = now();
        $subscription->end_date = match ($package->validity_unit) {
            'days' => now()->addDays($package->validity),
            'weeks' => now()->addWeeks($package->validity),
            'months' => now()->addMonths($package->validity),
            'years' => now()->addYears($package->validity),
            default => now()->addDays(30),
        };

        $subscription->status = 'active';
        $subscription->save();

        return back()->with('success', 'Subscription renewed successfully!');
    }


    public function cancelRequest(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'reason' => 'required|string|max:500',
        ]);

        $subscription = Subscription::findOrFail($request->subscription_id);

        // Cancel window setting
        $cancelWindow = setting('cancel_subscription_days') ?? 0;
        $cancelDeadline = \Carbon\Carbon::parse($subscription->start_date)->addDays($cancelWindow);

        // Check if eligible for cancellation
        if ($cancelWindow <= 0 || now()->gt($cancelDeadline)) {
            return back()->withErrors('Cancellation window has expired.');
        }

        if ($subscription->used_listings > 0) {
            return back()->withErrors('You cannot cancel because the subscription has already been used.');
        }

        if ($subscription->status !== 'active') {
            return back()->withErrors('Only active subscriptions can be canceled.');
        }

        // Mark as cancel requested
        $subscription->update([
            'status' => 'cancel_requested',
            'cancel_reason' => $request->reason,
            'cancel_requested_at' => now(),
        ]);
        // dd($subscription);

        return back()->with('success', 'Your cancel request has been sent to the admin.');
    }

    private function generateUniqueInvoiceNumber()
    {
        // Get prefix
        $prefix = setting('invoice_prefix', 'INV');

        // Case 1: Serial Numbering (if not using random digits)
        if (setting('invoice_serial') && !setting('use_random_digits')) {
            $serial = (int) setting('invoice_serial');

            do {
                $number = $prefix . str_pad($serial, 6, '0', STR_PAD_LEFT);

                // Add financial year if enabled
                if (setting('include_financial_year')) {
                    $number .= '/' . $this->getFinancialYear();
                }

                $serial++;
            } while (Invoice::where('invoice_number', $number)->exists());

            // Save updated serial back to DB
            Setting::updateOrCreate(
                ['key' => 'invoice_serial'],
                ['value' => $serial]
            );

            return $number;
        }

        // Case 2: Random Digits
        $digits = (int) setting('invoice_random_digits', 6);

        do {
            $randomPart = str_pad(mt_rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
            $number = $prefix . $randomPart;

            if (setting('include_financial_year')) {
                $number .= '/' . $this->getFinancialYear();
            }

        } while (Invoice::where('invoice_number', $number)->exists());

        return $number;
    }

    /**
     * Get current financial year in format 24-25
     */
    private function getFinancialYear()
    {
        $year = (int) date('y');
        $month = (int) date('m');

        if ($month >= 4) {
            return $year . '-' . sprintf("%02d", $year + 1);
        }

        return sprintf("%02d", $year - 1) . '-' . $year;
    }

}
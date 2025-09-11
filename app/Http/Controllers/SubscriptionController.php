<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->latest()
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

        // Get wallet balance (default 0 if no wallet yet)
        $walletBalance = optional($user->wallet)->balance ?? 0;

        return view('user.subscription-plan', compact('packages', 'walletBalance'));
    }

    
    public function ListPackage()
    {
        $user = Auth::guard('customer')->user();

        // get all active packages
        $packages = Package::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ get wallet balance (default 0 if no wallet exists yet)
        $walletBalance = optional($user->wallet)->balance ?? 0;

        return view('front.pricing', compact('packages', 'walletBalance'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'payment_method' => 'required|in:razorpay,wallet',
            'razorpay_payment_id' => 'required_if:payment_method,razorpay'
        ]);

        $package = Package::findOrFail($request->package_id);
        $customer = Auth::guard('customer')->user();

        //  Wallet balance check if wallet selected
        if ($request->payment_method === 'wallet') {
            $wallet = $customer->wallet;

            if (!$wallet || $wallet->balance < $package->offered_price) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient wallet balance.'
                ]);
            }

            // Deduct and record transaction
            $wallet->addTransaction(
                'debit',
                $package->offered_price,
                'Purchase Subscription',
                "Purchased {$package->name} plan",
                $package->id
            );
        }

        // Generate unique order number
        $orderNumber = 'SUB' . mt_rand(100000, 999999);

        // Subscription validity calculation
        $endDate = match ($package->validity_unit) {
            'days' => now()->addDays($package->validity),
            'weeks' => now()->addWeeks($package->validity),
            'months' => now()->addMonths($package->validity),
            'years' => now()->addYears($package->validity),
            default => now()->addDays(30),
        };

        // Create subscription
        $subscription = Subscription::create([
            'customer_id' => $customer->id,
            'package_id' => $package->id,
            'used_listings' => 0,
            'start_date' => now(),
            'end_date' => $endDate,
            'status' => 'active',
            'order_number' => $orderNumber,
        ]);

        // Store payment (Wallet or Razorpay)
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

        // Generate invoice number (INV + 6 random digits)
        $invoiceNumber = $this->generateUniqueInvoiceNumber();

        // Create invoice
        Invoice::create([
            'subscription_id' => $subscription->id,
            'invoice_number' => $invoiceNumber,
            'amount' => $package->offered_price,
            'currency' => 'INR',
            'issued_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'order_number' => $orderNumber,
            'invoice_number' => $invoiceNumber
        ]);
    }


    public function renew(Request $request)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);
        $package = $subscription->package;

        // Example: Extend subscription by package validity
        $subscription->start_date = now();
        $subscription->end_date = now()->addDays($package->validity); // adjust for unit if needed
        $subscription->status = 'active';
        $subscription->save();

        return redirect()->back()->with('success', 'Subscription renewed successfully!');
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
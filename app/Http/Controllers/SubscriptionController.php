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
            $cancelDeadline = \Carbon\Carbon::parse($subscription->start_date)->addDays($cancelWindow);
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
            'cancelWindow'
        ));
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


    public function store(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::findOrFail($request->package_id);

        // Generate unique order number
        $orderNumber = 'SUB' . mt_rand(100000, 999999);

        // Create subscription
        $endDate = match ($package->validity_unit) {
            'days' => now()->addDays($package->validity),
            'weeks' => now()->addWeeks($package->validity),
            'months' => now()->addMonths($package->validity),
            'years' => now()->addYears($package->validity),
            default => now()->addDays(30), // fallback
        };

        $subscription = Subscription::create([
            'customer_id' => Auth::guard('customer')->id(),
            'package_id' => $package->id,
            'used_listings' => 0,
            'start_date' => now(),
            'end_date' => $endDate,
            'status' => 'active',
            'order_number' => $orderNumber,
        ]);

        // Store payment
        Payment::create([
            'subscription_id' => $subscription->id,
            'gateway' => 'razorpay',
            'payment_id' => $request->razorpay_payment_id,
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


    private function generateUniqueInvoiceNumber()
    {
        do {
            $number = 'INV' . mt_rand(100000, 999999);
        } while (Invoice::where('invoice_number', $number)->exists());
        return $number;
    }


    public function ListPackage()
    {
        // get all active packages
        $packages = Package::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.pricing', compact('packages'));
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


}
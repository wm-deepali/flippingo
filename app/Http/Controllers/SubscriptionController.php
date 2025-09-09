<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function index()
    {
        $user = Auth::user(); // assuming 'Customer' is authenticated user

        // Get latest active subscription for the user
        $subscription = Subscription::with('package')
            ->where('customer_id', $user->id)
            ->where('status', 'active')
            ->latest()
            ->first();

        // Get all active packages
        $packages = Package::where('status', 'active')->get();

        return view('user.subscriptions', compact('subscription', 'packages'));
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

        // Create subscription
        $subscription = Subscription::create([
            'customer_id' => Auth::guard('customer')->user()->id, // assuming auth()->user() is Customer
            'package_id' => $package->id,
            'used_listings' => 0,
            'start_date' => now(),
            'end_date' => now()->addDays($package->listing_duration ?? 30),
            'status' => 'active',
        ]);

        // Store payment separately
        Payment::create([
            'subscription_id' => $subscription->id,
            'gateway' => 'razorpay',
            'payment_id' => $request->razorpay_payment_id,
            'amount' => $package->offered_price,
            'currency' => 'INR',
            'status' => 'success'
        ]);

        return response()->json(['success' => true]);
    }

    public function ListPackage()
    {
        // get all active packages
        $packages = Package::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.pricing', compact('packages'));
    }


}
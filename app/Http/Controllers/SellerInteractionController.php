<?php

namespace App\Http\Controllers;

use App\Models\SellerFeedback;
use App\Models\SellerEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerInteractionController extends Controller
{
    /* ============================
     | FEEDBACK (AUTH ONLY)
     ============================ */
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:customers,id',
            'rating'    => 'required|integer|min:1|max:5',
            'message'   => 'nullable|string',
        ]);

        $customer = Auth::guard('customer')->user();

        // prevent duplicate feedback
        $exists = SellerFeedback::where('seller_id', $request->seller_id)
            ->where('customer_id', $customer->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'message' => 'You have already submitted feedback for this seller.'
            ]);
        }

        SellerFeedback::create([
            'seller_id'   => $request->seller_id,
            'customer_id' => $customer->id,
            'rating'      => $request->rating,
            'message'     => $request->message,
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }

    /* ============================
     | ENQUIRY (PUBLIC)
     ============================ */
    public function submitEnquiry(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:customers,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'mobile'    => 'required|string|max:20',
            'message'   => 'required|string',
        ]);

        SellerEnquiry::create($request->only([
            'seller_id',
            'name',
            'email',
            'mobile',
            'message',
        ]));

        return back()->with('success', 'Your enquiry has been sent successfully!');
    }
}

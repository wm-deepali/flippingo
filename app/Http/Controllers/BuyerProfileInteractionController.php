<?php

namespace App\Http\Controllers;

use App\Models\SellerEnquiry;
use App\Models\SellerFeedback;
use Illuminate\Http\Request;

class BuyerProfileInteractionController extends Controller
{
    public function enquiries()
    {
        $buyer = auth('customer')->user();

        $enquiries = SellerEnquiry::where(function ($q) use ($buyer) {
            $q->where('email', $buyer->email)
                ->orWhere('mobile', $buyer->mobile);
        })
            ->latest()
            ->get();

        return view('user.buyer.profile-enquiries', compact('enquiries'));
    }

    public function feedback()
    {
        $buyer = auth('customer')->user();

        $feedbacks = SellerFeedback::where('customer_id', $buyer->id)
            ->with('seller')
            ->latest()
            ->get();

        return view('user.buyer.profile-feedback', compact('feedbacks'));
    }
}

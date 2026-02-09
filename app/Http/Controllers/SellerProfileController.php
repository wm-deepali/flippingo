<?php

namespace App\Http\Controllers;

use App\Models\SellerEnquiry;
use App\Models\SellerFeedback;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    // Enquiries coming from seller profile page
    public function profileEnquiries()
    {
        $enquiries = SellerEnquiry::where('seller_id', auth('customer')->id())
            ->latest()
            ->get();

        return view('user.seller.profile-enquiries', compact('enquiries'));
    }

    // Feedback / ratings on seller profile
    public function profileFeedback()
    {
        $feedbacks = SellerFeedback::where('seller_id', auth('customer')->id())
            ->latest()
            ->get();

        return view('user.seller.profile-feedback', compact('feedbacks'));
    }
}

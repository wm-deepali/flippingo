<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerEnquiry;
use App\Models\SellerFeedback;

class SellerProfileController extends Controller
{
    /* ===============================
     | SELLER PROFILE ENQUIRIES
     =============================== */
    public function enquiries()
    {
        $enquiries = SellerEnquiry::with('seller')
            ->latest()
            ->paginate(20);

        return view('admin.seller-profile.enquiries', compact('enquiries'));
    }


    /* ===============================
     | SELLER PROFILE FEEDBACK
     =============================== */
    public function feedback()
    {
        $feedbacks = SellerFeedback::with(['seller', 'customer'])
            ->latest()
            ->paginate(20);

        return view('admin.seller-profile.feedback', compact('feedbacks'));
    }
}

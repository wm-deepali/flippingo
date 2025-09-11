<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'submission_id' => 'required|integer|exists:form_submissions,id',
        ]);

        $user = Auth::guard('customer')->user();

        $exists = Wishlist::where('customer_id', $user->id)
            ->where('submission_id', $request->submission_id)
            ->exists();

        if ($exists) {
            // Remove from wishlist
            Wishlist::where('customer_id', $user->id)
                ->where('submission_id', $request->submission_id)
                ->delete();

            return response()->json(['added' => false]);
        } else {
            // Add to wishlist
            Wishlist::create([
                'customer_id' => $user->id,
                'submission_id' => $request->submission_id,
            ]);

            return response()->json(['added' => true]);
        }
    }
}

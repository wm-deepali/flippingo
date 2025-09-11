<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function addFunds(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::guard('customer')->user();

        $wallet = $user->wallet;

        if (!$wallet) {
            $wallet = $user->wallet()->create([
                'balance' => 0,
                'currency' => 'INR',  // or your default
                'status' => 'active',
            ]);
        }
        
        // Record credit transaction and update balance
        $transaction = $wallet->addTransaction(
            'credit',
            $request->amount / 100,  // converting paise to rupees
            'Money Added to Wallet',
            'Added funds via Razorpay',
            $request->razorpay_payment_id
        );

        if ($transaction) {
            return response()->json(['success' => true, 'message' => 'Wallet topped up successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to add funds to wallet'], 500);
    }
}


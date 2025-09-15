<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }
        
        $bank = $user->paymentMethods()->where('type', 'bank')->first();
        $upi = $user->paymentMethods()->where('type', 'upi')->first();
        $wire = $user->paymentMethods()->where('type', 'wire')->first();
        $paypal = $user->paymentMethods()->where('type', 'paypal')->first();

        return view('user.bank-account', compact('bank', 'upi', 'wire', 'paypal'));

    }

    public function saveBank(Request $request)
    {
        $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'ifsc_code' => 'nullable|string|max:15',
            'bank_name' => 'nullable|string|max:100',
            'branch_name' => 'nullable|string|max:100',
        ]);

        $user = Auth::guard('customer')->user();

        // Example: Save or update payment method for user
        $user->paymentMethods()->updateOrCreate(
            ['type' => 'bank'],
            [
                'account_holder_name' => $request->account_holder_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,
            ]
        );

        return redirect()->back()->with('success', 'Bank payment method saved successfully.');
    }

    public function saveUpi(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'upi_id' => 'required|string|max:100',
        ]);

        $user = Auth::guard('customer')->user();

        $user->paymentMethods()->updateOrCreate(
            ['type' => 'upi'],
            [
                'receiver_name' => $request->receiver_name,
                'upi_id' => $request->upi_id,
            ]
        );

        return redirect()->back()->with('success', 'UPI payment method saved successfully.');
    }

    public function saveWire(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string|max:50',
            'account_owner' => 'required|string|max:255',
            'bank_name' => 'required|string|max:100',
            'bank_address' => 'required|string|max:255',
            'swift_code' => 'nullable|string|max:50',
            'iban_number' => 'nullable|string|max:50',
        ]);

        $user = Auth::guard('customer')->user();

        $user->paymentMethods()->updateOrCreate(
            ['type' => 'wire'],
            [
                'account_number' => $request->account_number,
                'account_owner' => $request->account_owner,
                'bank_name' => $request->bank_name,
                'bank_address' => $request->bank_address,
                'swift_code' => $request->swift_code,
                'iban_number' => $request->iban_number,
            ]
        );

        return redirect()->back()->with('success', 'Wire Transfer payment method saved successfully.');
    }

    public function savePaypal(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'paypal_email' => 'required|email|max:255',
        ]);

        $user = Auth::guard('customer')->user();

        $user->paymentMethods()->updateOrCreate(
            ['type' => 'paypal'],
            [
                'receiver_name' => $request->receiver_name,
                'paypal_email' => $request->paypal_email,
            ]
        );

        return redirect()->back()->with('success', 'Paypal payment method saved successfully.');
    }
}

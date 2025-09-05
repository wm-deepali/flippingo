<?php

namespace App\Http\Controllers;

use App\Models\AccountDeletionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\OTP;
use Mail;

class ProfileController extends Controller
{
    // GET: Show profile page with customer details
    public function profile()
    {
        $customer = Auth::guard('customer')->user(); // logged-in customer
        $customer->load(['countryname']); // eager load relations

        return view('user.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'display_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'mobile' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'legal_name' => 'nullable|string|max:255',
            'business_email' => 'nullable|email|max:255',
            'full_address' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_pic', 'public');
            $validated['profile_pic'] = $path;
        }

        $customer->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully!',
            'customer' => $customer
        ]);
    }


    public function sendOtpBoth(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'type' => 'required|in:mobile,email',
        ]);

        $value = $request->value;
        $type = $request->type;
        $otp = rand(100000, 999999);

        // Delete old OTP for same value+type
        OTP::where('value', $value)->where('type', $type)->delete();

        // Store new OTP
        OTP::create([
            'value' => $value,
            'type' => $type,
            'otp' => $otp,
            'expiry' => now()->addMinutes(10),
            'verified' => false,
        ]);

        if ($type === 'mobile') {
            // Send via SMS
            $message = "{$otp} is the OTP to verify your Mobile Number at https://ashtonwell.com. Please do not share this OTP with anyone. Regards Ashton & Well";

            $dlt_id = '1707175291422915659';
            $pe_id = '1701175290968159932';
            $request_parameter = [
                'authkey' => '449195AevVjn7d6813877aP1',
                'mobiles' => $value,
                'sender' => 'ASHTWE',
                'message' => urlencode($message),
                'route' => '4',
                'country' => '91',
            ];
            $url = "http://sms.webmingo.in/api/sendhttp.php?";
            foreach ($request_parameter as $key => $val) {
                $url .= $key . '=' . $val . '&';
            }
            $url .= 'DLT_TE_ID=' . $dlt_id . '&PE_ID=' . $pe_id;
            $url = rtrim($url, "&");

            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $output = curl_exec($ch);
                curl_close($ch);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
            }
        } else {
            // Send via Email
            // Send via Email
            try {
                Mail::to($value)->send(new \App\Mail\OtpMail($otp));
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Email sending failed!'], 500);
            }

        }

        return response()->json([
            'success' => true,
            'message' => "OTP sent successfully on your {$type}!",
        ]);
    }

    public function verifyOTPBoth(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'type' => 'required|in:mobile,email',
            'otp' => 'required',
        ]);

        $value = $request->value;
        $type = $request->type;
        $otp = $request->otp;

        $isValid = OTP::verifyOTP($value, $otp, $type);

        if ($isValid) {
            // Get customer user from the "customer" guard
            $customer = Auth::guard('customer')->user();

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unauthorized'
                ], 401);
            }

            // If OTP was for mobile
            if ($type == 'mobile') {
                $customer->mobile = $value;
                $customer->mobile_verified_at = now();
                $customer->save();
            }

            // If OTP was for email
            if ($type == 'email') {
                $customer->email = $value;
                $customer->email_verified_at = now();
                $customer->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Invalid or expired OTP'
            ], 422);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // will check against password_confirmation
        ]);

        $customer = Auth::guard('customer')->user();
        $customer->password = Hash::make($request->password);
        $customer->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!'
        ]);
    }


    public function deleteAccount(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.'
            ], 404);
        }

        // Check if there’s already a pending deletion request
        $existingRequest = AccountDeletionRequest::where('customer_id', $customer->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a pending deletion request.'
            ]);
        }

        // Create new deletion request with reason
        AccountDeletionRequest::create([
            'customer_id' => $customer->id,
            'reason' => $request->reason, // will be null if user didn't provide one
        ]);

        // Log out the customer immediately
        Auth::guard('customer')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Your account deletion request has been sent to the admin. You have been logged out.'
        ]);
    }

}
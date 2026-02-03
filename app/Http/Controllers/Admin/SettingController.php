<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [];

        $envMap = [
            'smtp_host' => 'MAIL_HOST',
            'smtp_port' => 'MAIL_PORT',
            'smtp_username' => 'MAIL_USERNAME',
            'smtp_password' => 'MAIL_PASSWORD',
            'mail_encryption' => 'MAIL_ENCRYPTION',
            'mail_from_address' => 'MAIL_FROM_ADDRESS',
            'mail_from_name' => 'MAIL_FROM_NAME',
            'razorpay_enabled' => 'RAZORPAY_ENABLED',
            'razorpay_key_id' => 'RAZORPAY_KEY',
            'razorpay_key_secret' => 'RAZORPAY_SECRET',
            'stripe_enabled' => 'STRIPE_ENABLED',
            'stripe_publishable_key' => 'STRIPE_KEY',
            'stripe_secret_key' => 'STRIPE_SECRET',
            'pe_id' => 'SMS_PE_ID',
            'sender_id' => 'SMS_SENDER_ID',
            'auth_key' => 'SMS_AUTH_KEY',
        ];

        $keys = [
            // GST
            'igst',
            'cgst',
            'sgst',
            // Invoice
            'invoice_prefix',
            'invoice_serial',
            'use_random_digits',
            'invoice_random_digits',
            'include_financial_year',
            'billing_address',
            'billing_country',
            'billing_state',
            'billing_city',
            'billing_pincode',
            'billing_contact',
            'billing_email',
            'billing_website',
            'billing_terms',
            'billing_logo',
            // SMTP
            'smtp_host',
            'smtp_port',
            'smtp_username',
            'smtp_password',
            'mail_encryption',
            'mail_from_address',
            'mail_from_name',
            // Payment
            'razorpay_enabled',
            'razorpay_key_id',
            'razorpay_key_secret',
            'stripe_enabled',
            'stripe_publishable_key',
            'stripe_secret_key',
            // SMS
            'pe_id',
            'sender_id',
            'auth_key',
            // Seller Commission
            'default_commission',
            // Cancel Subscription
            'cancel_subscription_days',
            // Premium Seller
            'premium_sales_threshold',
            'premium_seller_note',


        ];

        foreach ($keys as $key) {
            $dbValue = Setting::where('key', $key)->value('value');

            if (!is_null($dbValue)) {
                if (in_array($key, ['razorpay_enabled', 'stripe_enabled', 'use_random_digits'])) {
                    $settings[$key] = (bool) $dbValue;
                } else {
                    $settings[$key] = $dbValue;
                }
            } else {
                $envKey = $envMap[$key] ?? null;
                if ($envKey) {
                    if (in_array($envKey, ['razorpay_enabled', 'stripe_enabled', 'use_random_digits'])) {
                        $settings[$key] = env($envKey) ? (bool) env($envKey) : false;
                    } else {
                        $settings[$key] = env($envKey);
                    }
                } else {
                    $settings[$key] = null;
                }
            }
        }

        // 🔹 Add SMS Templates (hardcoded text + env ID)
        $settings['sms_templates'] = [
            [
                'type' => 'verify_otp',
                'id' => env('SMS_DLT_ID'), // from .env
                'text' => "{otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is usable only once and is valid for 10 min. PLS DO NOT SHARE THE OTP WITH ANYONE"
            ],
            // you can add more templates here if needed...
        ];

        return view('admin.settings.index', compact('settings'));
    }



    public function update(Request $request)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            // Handle file uploads
            if ($request->hasFile($key)) {
                $file = $request->file($key);

                // Store in /storage/app/public/settings/
                $path = $file->store('settings', 'public');

                // Save only the relative path
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
            } else {
                // Handle normal values
                if (is_array($value)) {
                    $value = json_encode($value); // store arrays as JSON
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Settings updated successfully!']);
        }

        return back()->with('success', 'Settings updated successfully!');
    }

}

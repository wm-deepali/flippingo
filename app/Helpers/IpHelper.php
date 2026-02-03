<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class IpHelper
{
    public static function countryCode(): string
    {
        // ✅ If already detected in this session, reuse it
        if (session()->has('country_code')) {
            return session('country_code');
        }

        try {
            $response = Http::timeout(3)->get('https://ipapi.co/json/');

            if ($response->successful()) {
                // Normalize to lowercase: "IN" → "in"
                $countryCode = strtolower($response->json('country_code') ?? 'in');

                // 🔒 Store in session (one time per user)
                session(['country_code' => $countryCode]);

                return $countryCode;
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // Fallback + store fallback
        session(['country_code' => 'in']);

        return 'in';
    }
}

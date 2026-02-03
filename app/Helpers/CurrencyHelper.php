<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class CurrencyHelper
{
    public static function usdRate(): float
    {
        // ✅ Reuse from session if already fetched
        if (session()->has('usd_rate')) {
            return session('usd_rate');
        }

        try {
            $response = Http::timeout(4)
                ->retry(2, 200) // optional but recommended
                ->get('https://open.er-api.com/v6/latest/INR');

            if ($response->successful()) {
                $rate = (float) ($response->json('rates.USD') ?? 0);

                if ($rate > 0) {
                    // 🔒 Store once per session
                    session(['usd_rate' => $rate]);
                    return $rate;
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // 🔁 Fallback (from settings or hardcoded)
        $fallbackRate = (float) setting('usd_exchange_rate', 0.012);

        // 🔒 Store fallback too (avoid repeated API hits)
        session(['usd_rate' => $fallbackRate]);

        return $fallbackRate;
    }
}

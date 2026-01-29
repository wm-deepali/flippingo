<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TrustpilotService
{
    public function isEnabled(): bool
    {
        return config('services.trustpilot.enabled');
    }

    public function getReviews(int $limit = 5): array
    {
        if (!$this->isEnabled()) {
            return [];
        }

        $response = Http::get(
            "https://api.trustpilot.com/v1/business-units/" .
            config('services.trustpilot.business_unit_id') .
            "/reviews",
            [
                'apikey' => config('services.trustpilot.api_key'),
                'perPage' => $limit,
            ]
        );

        return $response->json('reviews', []);
    }
}
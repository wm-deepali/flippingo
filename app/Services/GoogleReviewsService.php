<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleReviewsService
{
    // Check if service is enabled
    public function isEnabled(): bool
    {
        return config('services.google_reviews.enabled');
    }

    // Fetch Google reviews
    public function getReviews(): array
    {
        // Safety check
        if (!$this->isEnabled()) {
            return [];
        }

        $response = Http::get(
            'https://maps.googleapis.com/maps/api/place/details/json',
            [
                'place_id' => config('services.google_reviews.place_id'),
                'fields'   => 'rating,user_ratings_total,reviews',
                'key'      => config('services.google_reviews.api_key'),
            ]
        );


        return $response->json('result.reviews', []);
    }
}
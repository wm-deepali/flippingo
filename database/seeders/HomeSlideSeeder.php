<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSlide;

class HomeSlideSeeder extends Seeder
{
    public function run(): void
    {
        HomeSlide::truncate();

        HomeSlide::create([
            'title'      => 'How to Start Selling Business on Flippingo Marketplace',
            'highlight'  => 'Get verified → List → Sell → Get Paid.',
            'features'   => [
                'Sell your business, website, app, or social account on Flippingo with ease.',
                'Reach verified buyers instantly.',
                'Secure & fast payout after sale.',
            ],
            'media_type' => 'image',
            'media_path' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop',
            'btn1_text'  => 'Start selling',
            'btn1_icon'  => 'fas fa-plus',
            'btn1_link'  => '/sell',
            'btn2_text'  => 'View listings',
            'btn2_icon'  => 'fas fa-eye',
            'btn2_link'  => '/listing-list',
            'sort_order' => 1,
            'is_active'  => 1,
        ]);

        HomeSlide::create([
            'title'      => 'Buy Your Next Digital Asset',
            'highlight'  => 'Compare options, connect with sellers, and purchase securely.',
            'features'   => [
                'Discover verified businesses & websites.',
                'Transparent pricing and performance metrics.',
                'Safe and secure transactions.',
            ],
            'media_type' => 'image',
            'media_path' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
            'btn1_text'  => 'Browse Now',
            'btn1_icon'  => 'fas fa-search',
            'btn1_link'  => '/listing-list',
            'btn2_text'  => 'Learn More',
            'btn2_icon'  => 'fas fa-info-circle',
            'btn2_link'  => '/how-it-works',
            'sort_order' => 2,
            'is_active'  => 1,
        ]);

        HomeSlide::create([
            'title'      => 'Monetize Your Digital Assets',
            'highlight'  => 'List in minutes → Get offers → Sell fast.',
            'features'   => [
                'Turn your website or app into cash.',
                'Receive multiple buyer offers.',
                'Close deals faster with Flippingo.',
            ],
            'media_type' => 'image',
            'media_path' => 'https://images.unsplash.com/photo-1516321310766-90ab77e47b3a?w=800&h=600&fit=crop',
            'btn1_text'  => 'List Asset',
            'btn1_icon'  => 'fas fa-plus-circle',
            'btn1_link'  => '/sell',
            'btn2_text'  => 'See Examples',
            'btn2_icon'  => 'fas fa-images',
            'btn2_link'  => '/examples',
            'sort_order' => 3,
            'is_active'  => 1,
        ]);
    }
}
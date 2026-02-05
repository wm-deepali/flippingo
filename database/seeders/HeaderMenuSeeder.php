<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class HeaderMenuSeeder extends Seeder
{
    public function run()
    {
        $menu = [
            ['key' => 'meet-our-team', 'label' => 'Meet Our Team', 'active' => true, 'order' => 1],
            ['key' => 'insight', 'label' => 'Insight', 'active' => true, 'order' => 2],
            ['key' => 'buyers-mandate', 'label' => 'Buyers Mandate', 'active' => true, 'order' => 3],
            ['key' => 'why-flippingo', 'label' => 'Why Flippingo', 'active' => true, 'order' => 4],
            ['key' => 'blogs', 'label' => 'Blogs', 'active' => true, 'order' => 5],
            ['key' => 'sell-digitally', 'label' => 'Sell Digitally', 'active' => true, 'order' => 6],
            ['key' => 'services', 'label' => 'Services', 'active' => true, 'order' => 7],
            ['key' => 'resources', 'label' => 'Resources', 'active' => true, 'order' => 8],
            ['key' => 'contact-us', 'label' => 'Contact Us', 'active' => true, 'order' => 9],
        ];

        Setting::updateOrCreate(
            ['key' => 'header_menu'],
            ['value' => json_encode($menu)]
        );
    }
}

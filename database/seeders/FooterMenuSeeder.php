<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class FooterMenuSeeder extends Seeder
{
    public function run()
    {
        // QUICK LINKS
        Setting::updateOrCreate(
            ['key' => 'footer_menu_quick'],
            ['value' => json_encode([
                [
                    'key' => 'listing-list',
                    'label' => 'Browse Listing',
                    'active' => true,
                    'order' => 1,
                ],
                [
                    'key' => 'pricing',
                    'label' => 'Pricing',
                    'active' => true,
                    'order' => 2,
                ],
                [
                    'key' => 'add-listing',
                    'label' => 'Sell Assets',
                    'active' => true,
                    'order' => 3,
                ],
                [
                    'key' => 'how-it-works',
                    'label' => 'How it Works',
                    'active' => true,
                    'order' => 4,
                ],
                [
                    'key' => 'services',
                    'label' => 'Our Services',
                    'active' => true,
                    'order' => 5,
                ],
                [
                    'key' => 'resources',
                    'label' => 'Resources',
                    'active' => true,
                    'order' => 6,
                ],
            ])]
        );

        // KNOW MORE
        Setting::updateOrCreate(
            ['key' => 'footer_menu_know'],
            ['value' => json_encode([
                [
                    'key' => 'about-us',
                    'label' => 'About Us',
                    'active' => true,
                    'order' => 1,
                ],
                [
                    'key' => 'meet-our-team',
                    'label' => 'Meet Our Team',
                    'active' => true,
                    'order' => 2,
                ],
                [
                    'key' => 'career',
                    'label' => 'Career with Us',
                    'active' => true,
                    'order' => 3,
                ],
                [
                    'key' => 'insight',
                    'label' => 'Insight',
                    'active' => true,
                    'order' => 4,
                ],
                [
                    'key' => 'why-flippingo',
                    'label' => 'Why Us',
                    'active' => true,
                    'order' => 5,
                ],
                [
                    'key' => 'contact-us',
                    'label' => 'Contact Us',
                    'active' => true,
                    'order' => 6,
                ],
                [
                    'key' => 'testimonial',
                    'label' => 'Feedback & Testimonials',
                    'active' => true,
                    'order' => 7,
                ],
            ])]
        );

        // HELP & SUPPORT
        Setting::updateOrCreate(
            ['key' => 'footer_menu_help'],
            ['value' => json_encode([
                [
                    'key' => 'faq',
                    'label' => 'FAQ',
                    'active' => true,
                    'order' => 1,
                ],
                [
                    'key' => 'dashboard.raise-ticket',
                    'label' => 'Raise a Ticket',
                    'active' => true,
                    'order' => 2,
                ],
                [
                    'key' => 'blogs',
                    'label' => 'Blogs',
                    'active' => true,
                    'order' => 3,
                ],
            ])]
        );
    }
}

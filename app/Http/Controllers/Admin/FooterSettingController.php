<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class FooterSettingController extends Controller
{
    public function index()
    {
        // 1️⃣ Fixed + placeholder pages
        $pages = [
            // Quick Links
            ['key' => 'listing-list', 'label' => 'Browse Listing'],
            ['key' => 'pricing', 'label' => 'Pricing'],
            ['key' => 'add-listing', 'label' => 'Sell Assets'],
            ['key' => 'how-it-works', 'label' => 'How it Works'],
            ['key' => 'services', 'label' => 'Our Services'],
            ['key' => 'resources', 'label' => 'Resources'],

            // Know More
            ['key' => 'about-us', 'label' => 'About Us'],
            ['key' => 'meet-our-team', 'label' => 'Meet Our Team'],
            ['key' => 'career', 'label' => 'Career with Us'],
            ['key' => 'insight', 'label' => 'Insight'],
            ['key' => 'why-flippingo', 'label' => 'Why Us'],
            ['key' => 'contact-us', 'label' => 'Contact Us'],
            ['key' => 'testimonial', 'label' => 'Feedback & Testimonials'],

            // Help & Support
            ['key' => 'faq', 'label' => 'FAQ'],
            ['key' => 'dashboard.raise-ticket', 'label' => 'Raise a Ticket'],
            ['key' => 'blogs', 'label' => 'Blogs'],
        ];

        // 2️⃣ Dynamic CMS pages
        $cmsPages = \App\Models\Page::where('status', 'published')
            ->get()
            ->map(function ($page) {
                return [
                    'key' => 'page.show',
                    'param' => $page->slug, // important
                    'label' => $page->title,
                ];
            })
            ->toArray();


        return view('admin.footer-settings.index', compact('pages', 'cmsPages'));
    }


    public function store(Request $request)
    {
        // ================= FOOTER MENUS =================
        Setting::updateOrCreate(
            ['key' => 'footer_menu_quick'],
            ['value' => json_encode($this->normalizeMenu($request->quick))]
        );

        Setting::updateOrCreate(
            ['key' => 'footer_menu_know'],
            ['value' => json_encode($this->normalizeMenu($request->know))]
        );

        Setting::updateOrCreate(
            ['key' => 'footer_menu_help'],
            ['value' => json_encode($this->normalizeMenu($request->help))]
        );

        // ================= COPYRIGHT =================
        Setting::updateOrCreate(
            ['key' => 'footer_copyright'],
            ['value' => $request->footer_copyright ?? '']
        );

        // ================= CONTACT INFO =================
        $contactKeys = [
            'footer_address',
            'footer_helpline',
            'footer_email',
            'footer_whatsapp',
        ];

        foreach ($contactKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        // FOOTER LOGO
        if ($request->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->store('footer', 'public');
            Setting::updateOrCreate(
                ['key' => 'footer_logo'],
                ['value' => $path]
            );
        }


        return back()->with('success', 'Footer settings updated successfully.');
    }



    private function normalizeMenu($input)
    {
        $menu = [];

        foreach ($input ?? [] as $uniqueKey => $item) {
            $menu[$uniqueKey] = [
                'key' => $item['key'] ?? null,
                'param' => $item['param'] ?? null, // CMS only
                'label' => $item['label'] ?? null,
                'order' => (int) ($item['order'] ?? 0),
                'active' => isset($item['active']), // 🔥 FIX
            ];
        }

        return $menu;
    }

}

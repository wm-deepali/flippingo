<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class HeaderSettingController extends Controller
{
    public function index()
    {
        $pages = [
            ['key' => 'meet-our-team', 'label' => 'Meet Our Team'],
            ['key' => 'insight', 'label' => 'Insight'],
            ['key' => 'buyers-mandate', 'label' => 'Buyers Mandate'],
            ['key' => 'why-flippingo', 'label' => 'Why Flippingo'],
            ['key' => 'blogs', 'label' => 'Blogs'],
            ['key' => 'sell-digitally', 'label' => 'Sell Digitally'],
            ['key' => 'services', 'label' => 'Services'],
            ['key' => 'resources', 'label' => 'Resources'],
            ['key' => 'contact-us', 'label' => 'Contact Us'],
        ];

        return view('admin.header-settings.index', compact('pages'));
    }

    public function store(Request $request)
    {
        /* =========================
         | FILE UPLOADS
         ========================= */

        // Header Logo
        if ($request->hasFile('header_logo')) {
            $path = $request->file('header_logo')->store('header', 'public');
            Setting::updateOrCreate(
                ['key' => 'header_logo'],
                ['value' => $path]
            );
        }

        // Favicon
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('favicon', 'public');
            Setting::updateOrCreate(
                ['key' => 'favicon'],
                ['value' => $path]
            );
        }

        // OG Image
        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('og', 'public');
            Setting::updateOrCreate(
                ['key' => 'og_image'],
                ['value' => $path]
            );
        }

        /* =========================
         | HEADER MENU
         ========================= */

        $menu = [];

        foreach ($request->menu ?? [] as $item) {
            $menu[] = [
                'key'    => $item['key'],
                'label'  => $item['label'],
                'active' => isset($item['active']),
                'order'  => (int) ($item['order'] ?? 0),
            ];
        }

        Setting::updateOrCreate(
            ['key' => 'header_menu'],
            ['value' => json_encode($menu)]
        );

        /* =========================
         | SEO & META
         ========================= */

        $simpleSettings = [
            'meta_title',
            'meta_keywords',
            'meta_description',
            'default_alt',
            'og_title',
            'og_description',
            'header_scripts',
        ];

        foreach ($simpleSettings as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Header settings saved successfully');
    }
}

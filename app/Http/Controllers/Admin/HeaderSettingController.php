<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        // HEADER LOGO
        if ($request->hasFile('header_logo')) {
            $path = $request->file('header_logo')->store('header', 'public');
            Setting::updateOrCreate(
                ['key' => 'header_logo'],
                ['value' => $path]
            );
        }

        // HEADER MENU
        $menu = [];

        foreach ($request->menu ?? [] as $item) {
            $menu[] = [
                'key' => $item['key'],
                'label' => $item['label'],   // ✅ SAVE LABEL
                'active' => isset($item['active']),
                'order' => (int) ($item['order'] ?? 0),
            ];

        }

        Setting::updateOrCreate(
            ['key' => 'header_menu'],
            ['value' => json_encode($menu)]
        );

        return redirect()->back()->with('success', 'Header settings saved successfully');
    }
}

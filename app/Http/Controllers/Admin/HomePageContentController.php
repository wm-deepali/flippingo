<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use Illuminate\Http\Request;

class HomePageContentController extends Controller
{
    /**
     * Show Home Page Content CMS
     */
    public function index()
    {
        $sections = HomePageContent::all()->keyBy('section_key');

        // Define fixed homepage sections here
        $defaultSections = [
            'hero' => 'Hero Section',
            'featured' => 'Featured Listings',
            'most_searched' => 'Most Searched Businesses',
        ];


        return view('admin.cms.home-page-content', compact(
            'sections',
            'defaultSections'
        ));
    }

    /**
     * Save / Update Home Page Content
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'sections' => 'required|array',
            'sections.*.title' => 'nullable|string|max:255',
            'sections.*.description' => 'nullable|string',
        ]);

        foreach ($data['sections'] as $key => $content) {
            HomePageContent::updateOrCreate(
                ['section_key' => $key],
                [
                    'title' => $content['title'] ?? null,
                    'description' => $content['description'] ?? null,
                ]
            );
        }

        // Optional: clear cache if used on frontend
        cache()->forget('home_page_content');

        return redirect()
            ->back()
            ->with('success', 'Home page content updated successfully.');
    }
}

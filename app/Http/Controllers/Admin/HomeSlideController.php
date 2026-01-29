<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSlideController extends Controller
{
    /**
     * List slides
     */
    public function index()
    {
        $slides = HomeSlide::orderBy('sort_order')->get();
        return view('admin.home-slides.index', compact('slides'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.home-slides.create');
    }

    /**
     * Store slide
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'highlight'    => 'nullable|string|max:255',
            'features'     => 'nullable|array',
            'features.*'   => 'nullable|string|max:255',

            'media_type'   => 'required|in:image,video',
            'media_file'   => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4',

            'btn1_text'    => 'nullable|string|max:100',
            'btn1_icon'    => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',

            'btn2_text'    => 'nullable|string|max:100',
            'btn2_icon'    => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',

            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        // Handle media upload
        if ($request->hasFile('media_file')) {
            $data['media_path'] = $request->file('media_file')
                ->store('home-slides', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        HomeSlide::create($data);

        return redirect()
            ->route('admin.home-slides.index')
            ->with('success', 'Home slide created successfully');
    }

    /**
     * Show edit form
     */
    public function edit(HomeSlide $homeSlide)
    {
        return view('admin.home-slides.edit', compact('homeSlide'));
    }

    /**
     * Update slide
     */
    public function update(Request $request, HomeSlide $homeSlide)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'highlight'    => 'nullable|string|max:255',
            'features'     => 'nullable|array',
            'features.*'   => 'nullable|string|max:255',

            'media_type'   => 'required|in:image,video',
            'media_file'   => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4',

            'btn1_text'    => 'nullable|string|max:100',
            'btn1_icon'    => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',

            'btn2_text'    => 'nullable|string|max:100',
            'btn2_icon'    => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',

            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        // Replace media if uploaded
        if ($request->hasFile('media_file')) {
            if ($homeSlide->media_path) {
                Storage::disk('public')->delete($homeSlide->media_path);
            }

            $data['media_path'] = $request->file('media_file')
                ->store('home-slides', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $homeSlide->update($data);

        return redirect()
            ->route('admin.home-slides.index')
            ->with('success', 'Home slide updated successfully');
    }

    /**
     * Delete slide
     */
    public function destroy(HomeSlide $homeSlide)
    {
        if ($homeSlide->media_path) {
            Storage::disk('public')->delete($homeSlide->media_path);
        }

        $homeSlide->delete();

        return redirect()
            ->route('admin.home-slides.index')
            ->with('success', 'Home slide deleted successfully');
    }

    /**
     * Toggle active status (AJAX friendly)
     */
    public function toggleStatus(HomeSlide $homeSlide)
    {
        $homeSlide->update([
            'is_active' => !$homeSlide->is_active
        ]);

        return response()->json(['status' => 'success']);
    }
}
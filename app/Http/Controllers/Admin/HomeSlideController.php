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
            'video_type'   => 'nullable|in:upload,youtube,vimeo,external',

            'media_file'   => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm',
            'media_url'    => 'nullable|url',

            'btn1_text'    => 'nullable|string|max:100',
            'btn1_icon'    => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',

            'btn2_text'    => 'nullable|string|max:100',
            'btn2_icon'    => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',

            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        /* ------------------------------
         | Handle Media
         ------------------------------ */
        $data['media_path'] = null;

        if ($request->media_type === 'video') {

            // Uploaded video
            if ($request->video_type === 'upload' && $request->hasFile('media_file')) {
                $data['media_path'] = $request->file('media_file')
                    ->store('home-slides', 'public');
            }
            // External video URL

            elseif ($request->filled('media_url')) {

    if ($request->video_type === 'youtube') {
        $embedUrl = $this->getYoutubeEmbedUrl($request->media_url);

        if ($embedUrl) {
            $data['media_path'] = $embedUrl;
        }
    } else {
        // Vimeo / External
        $data['media_path'] = $request->media_url;
    }
}


        } else {
            // Image upload
            if ($request->hasFile('media_file')) {
                $data['media_path'] = $request->file('media_file')
                    ->store('home-slides', 'public');
            }
        }

        $data['is_active'] = $request->boolean('is_active');

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
            'video_type'   => 'nullable|in:upload,youtube,vimeo,external',

            'media_file'   => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm',
            'media_url'    => 'nullable|url',

            'btn1_text'    => 'nullable|string|max:100',
            'btn1_icon'    => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',

            'btn2_text'    => 'nullable|string|max:100',
            'btn2_icon'    => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',

            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        /* ------------------------------
         | Replace Media (if changed)
         ------------------------------ */
        if ($request->media_type === 'video') {

            // Uploaded video replacement
            if ($request->video_type === 'upload' && $request->hasFile('media_file')) {

                if ($homeSlide->video_type === 'upload' && $homeSlide->media_path) {
                    Storage::disk('public')->delete($homeSlide->media_path);
                }

                $data['media_path'] = $request->file('media_file')
                    ->store('home-slides', 'public');
            }
            // External video URL replacement
          elseif ($request->filled('media_url')) {

    if ($request->video_type === 'youtube') {
        $embedUrl = $this->getYoutubeEmbedUrl($request->media_url);

        if ($embedUrl) {
            $data['media_path'] = $embedUrl;
        }
    } else {
        // Vimeo / External
        $data['media_path'] = $request->media_url;
    }
}


        } else {
            // Image replacement
            if ($request->hasFile('media_file')) {

                if ($homeSlide->media_type === 'image' && $homeSlide->media_path) {
                    Storage::disk('public')->delete($homeSlide->media_path);
                }

                $data['media_path'] = $request->file('media_file')
                    ->store('home-slides', 'public');
            }
        }

        $data['is_active'] = $request->boolean('is_active');

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
        // Delete only uploaded files (not external URLs)
        if ($homeSlide->video_type === 'upload' && $homeSlide->media_path) {
            Storage::disk('public')->delete($homeSlide->media_path);
        }

        if ($homeSlide->media_type === 'image' && $homeSlide->media_path) {
            Storage::disk('public')->delete($homeSlide->media_path);
        }

        $homeSlide->delete();

        return redirect()
            ->route('admin.home-slides.index')
            ->with('success', 'Home slide deleted successfully');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(HomeSlide $homeSlide)
    {
        $homeSlide->update([
            'is_active' => !$homeSlide->is_active
        ]);

        return response()->json(['status' => 'success']);
    }

    private function getYoutubeEmbedUrl(string $url): ?string
{
    preg_match(
        '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
        $url,
        $matches
    );

    return !empty($matches[1])
        ? 'https://www.youtube.com/embed/' . $matches[1]
        : null;
}

}

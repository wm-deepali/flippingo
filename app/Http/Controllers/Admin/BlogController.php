<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all(); // Pass categories
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'slug_url' => 'required|string|unique:blogs,slug',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id', // Validate category_id
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        $blog = new Blog();
        $blog->title = $validated['title'];
        $blog->detail = $validated['detail'];
        $blog->slug = $validated['slug_url'];
        $blog->meta_title = $validated['meta_title'];
        $blog->meta_description = $validated['meta_description'];
        $blog->meta_keyword = $validated['meta_keywords'];
        $blog->category_id = $validated['category_id']; // Assign category_id

        if ($request->hasFile('thumbnail')) {
            $blog->thumbnail = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
        }

        if ($request->hasFile('banner')) {
            $blog->banner = $request->file('banner')->store('blogs/banners', 'public');
        }

        $blog->status = 'published'; // or default value
        $blog->save();

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all(); // Pass categories for edit form
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug_url' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'detail' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id', // Validate category_id
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $blog->fill([
            'title' => $validated['title'],
            'slug' => $validated['slug_url'],
            'meta_title' => $validated['meta_title'],
            'meta_keyword' => $validated['meta_keywords'],
            'meta_description' => $validated['meta_description'],
            'detail' => $validated['detail'],
            'category_id' => $validated['category_id'], // Assign category_id
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
            $blog->thumbnail = $thumbnailPath;
        }

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('blogs/banners', 'public');
            $blog->banner = $bannerPath;
        }

        $blog->save();

        return response()->json(['message' => 'Blog updated successfully.']);
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Optional: delete thumbnail & banner files if stored
        if ($blog->thumbnail && \Storage::disk('public')->exists($blog->thumbnail)) {
            \Storage::disk('public')->delete($blog->thumbnail);
        }

        if ($blog->banner && \Storage::disk('public')->exists($blog->banner)) {
            \Storage::disk('public')->delete($blog->banner);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully.']);
    }


    public function publicIndex()
    {
        $blogs = Blog::latest()->paginate(10); // or whatever your pagination number is
        $recentBlogs = Blog::latest()->take(4)->get(); // Adjust the count if needed

        return view('front.blogs', compact('blogs', 'recentBlogs'));
    }

    public function publicShow($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $recentBlogs = Blog::latest()
            ->where('id', '!=', $blog->id)->take(4)->get(); // Optional: reuse sidebar

        $categories = BlogCategory::latest()->where('status', 'Published')->get();

        return view('front.blog-details', compact('blog', 'recentBlogs', 'categories'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Blog::where('title', 'LIKE', "%{$query}%")
            ->orWhere('detail', 'LIKE', "%{$query}%")
            ->get();

        return view('front.blogs.search-results', compact('results', 'query'));
    }
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $blogs = Blog::published()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(10);

        $categories = BlogCategory::where('status', 'Published')
            ->where('id', '!=', $category->id)
            ->get();

        return view('front.blogs-category', compact('category', 'blogs', 'categories'));
    }


}

<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FormSubmission;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')->get();

        // Latest submission per category
        $submissionsByCategory = [];
        foreach ($categories as $category) {
            $latestSubmission = FormSubmission::whereHas('form', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->with('form', 'customer', 'files')
                ->latest()
                ->first();

            if ($latestSubmission) {
                $submissionsByCategory[$category->id] = $latestSubmission;
            }
        }

        // All latest submissions (one per category) for "All" tab
        // For simplicity, you may also load all submissions or customize as needed
        $allSubmissions = collect($submissionsByCategory)->values();

        $blogs = Blog::with('category')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('status', 'active')->get();

        return view('front.index', compact('categories', 'submissionsByCategory', 'allSubmissions', 'blogs'));
    }


    public function addListing()
    {
        if (!Auth::guard('customer')->check()) {
            $intendedUrl = 'add-listing';
            return redirect()->route('authentication-signup', ['redirect' => $intendedUrl]);
        }

        // Get latest active categories, ordered by newest first
        $categories = Category::where('status', true)
            ->orderBy('created_at', 'desc')
            ->with('form')  // eager load form relationship
            ->get();

        return view('front.add-listing', compact('categories'));
    }

   public function FormSubmissionList()
{
    $categories = Category::where('status', 'active')->get();

    $submissionsByCategory = [];

    foreach ($categories as $category) {
        $allSubmissions = FormSubmission::whereHas('form', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->with('form.category', 'customer', 'files')
            ->latest()
            ->get();

        // Only include categories that have at least one submission
        if ($allSubmissions->isNotEmpty()) {
            $submissionsByCategory[$category->id] = $allSubmissions;
        }
    }

    // For "All" tab → flatten everything into one collection
    $allSubmissions = collect($submissionsByCategory)->flatten(1);

    return view('front.listing-list', compact('categories', 'submissionsByCategory', 'allSubmissions'));
}

}
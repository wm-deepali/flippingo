<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FormSubmission;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')->get();

        $submissionsByCategory = [];
        $allSubmissionsFlat = [];
        $now = now();
        $categorySubmissionCounts = [];

        foreach ($categories as $category) {
            // Get all sponsored submissions per category 
            $sponsoredSubmissions = FormSubmission::whereHas('form', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->whereNotNull('sponsor_display_until')
                ->where('sponsor_display_until', '>', $now)
                ->with('form.category', 'form.formData', 'customer', 'files')
                ->latest()
                ->get();

            if ($sponsoredSubmissions->isNotEmpty()) {  // Only proceed if submissions exist
                $categorySubmissionCounts[$category->id] = $sponsoredSubmissions->count();;

                // Process each submission to build summary fields etc.
                $processedSubmissions = $sponsoredSubmissions->map(function ($submission) {
                    $fields = json_decode($submission->data, true) ?? [];
                    $formFields = collect(data_get($submission, 'form.formData.fields', []));
                    $summaryFields = [];

                    foreach ($fields as $field_id => $field) {
                        $meta = $formFields->firstWhere('field_id', $field_id);
                        if (($meta && !empty($meta['show_on_summary'])) || (!empty($field['show_on_summary']))) {
                            $summaryFields[] = [
                                'field_id' => $field_id,
                                'label' => $meta['label'] ?? $field['label'] ?? '',
                                'icon' => $meta['icon'] ?? $field['icon'] ?? '',
                                'value' => $field['value'] ?? '',
                            ];
                        }
                    }

                    $submission->summaryFields = $summaryFields;
                    $submission->category = $submission->form->category;
                    $submission->imageFile = collect($submission->files)->firstWhere('show_on_summary', true);

                    return $submission;
                });

                $submissionsByCategory[$category->id] = $processedSubmissions;
                $allSubmissionsFlat = array_merge($allSubmissionsFlat, $processedSubmissions->toArray());
            }
        }

        $allSubmissions = collect($allSubmissionsFlat);

        $blogs = Blog::with('category')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('status', 'active')->get();
        return view('front.index', compact('categories', 'submissionsByCategory', 'allSubmissions', 'blogs', 'testimonials', 'categorySubmissionCounts'));
    }



    public function addListing(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            $intendedUrl = 'add-listing';
            return redirect()->route('authentication-signup', ['redirect' => $intendedUrl]);
        }

        $customer = Auth::guard('customer')->user();
        $subscription = $customer->activeSubscription;

        // Check if subscription exists and is active (not expired)
        if (!$subscription || $subscription->end_date < now()) {
            $errorMessage = 'Please purchase a subscription before creating a listing.';
            if ($subscription && $subscription->end_date < now()) {
                $subscription->update(['status' => 'expired']);
                $errorMessage = 'Your subscription has expired. Please renew or purchase a new subscription.';
            }

            if ($request->has('from') && $request->from === 'dashboard') {
                return redirect()->route(
                    'dashboard.subscription-plan',
                    [
                        'redirect' => 'add-listing',
                        'error' => $errorMessage
                    ]
                );
            }

            return redirect()->route(
                'pricing',
                [
                    'redirect' => 'add-listing',
                    'error' => $errorMessage
                ]
            );
        }

        // Check subscription usage limit
        $package = $subscription->package;
        if ($subscription->used_listings >= $package->listings) {
            $errorMessage = 'Your subscription Listing limit has been reached. Please upgrade.';

            if ($request->has('from') && $request->from === 'dashboard') {
                return redirect()->route(
                    'dashboard.subscription-plan',
                    [
                        'redirect' => 'add-listing',
                        'error' => $errorMessage
                    ]
                );
            }

            return redirect()->route(
                'pricing',
                [
                    'redirect' => 'add-listing',
                    'error' => $errorMessage
                ]
            );
        }

        // Load categories
        $categories = Category::where('status', true)
            ->orderBy('created_at', 'desc')
            ->with('form')
            ->get();

        return view('front.add-listing', compact('categories'));
    }



    public function FormSubmissionList()
    {
        $categories = Category::where('status', 'active')->get();

        $submissionsByCategory = [];
        $allSubmissionsFlat = [];

        foreach ($categories as $category) {
            $allSubmissions = FormSubmission::whereHas('form', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->with('form.category', 'form.formData', 'customer', 'files')
                ->latest()
                ->get();

            // Map each submission's field values to current form field meta
            $allSubmissionsMapped = $allSubmissions->map(function ($submission) {
                $fields = json_decode($submission->data, true) ?? [];
                $formFields = collect(data_get($submission, 'form.formData.fields', []));
                $summaryFields = [];

                foreach ($fields as $field_id => $field) {
                    $meta = $formFields->firstWhere('field_id', $field_id);
                    if (($meta && !empty($meta['show_on_summary'])) || (!empty($field['show_on_summary']))) {
                        $summaryFields[] = [
                            'field_id' => $field_id,
                            'label' => $meta['label'] ?? $field['label'] ?? '',
                            'icon' => $meta['icon'] ?? $field['icon'] ?? '',
                            'value' => $field['value'] ?? '',
                        ];
                    }
                }

                // Attach summary fields for use in blade
                $submission->summaryFields = $summaryFields;
                $submission->category = $submission->form->category;

                // Select image
                $imageFile = collect($submission->files)->firstWhere('show_on_summary', true);
                $submission->imageFile = $imageFile;

                return $submission;
            });

            if ($allSubmissionsMapped->isNotEmpty()) {
                $submissionsByCategory[$category->id] = $allSubmissionsMapped;
                $allSubmissionsFlat = array_merge($allSubmissionsFlat, $allSubmissionsMapped->toArray());
            }
        }

        // Combines all submissions from all categories for "All" tab
        $allSubmissions = collect($allSubmissionsFlat);

        // Remove dd() for live use
        // dd($allSubmissions->toArray());

        return view('front.listing-list', compact('categories', 'submissionsByCategory', 'allSubmissions'));
    }

}
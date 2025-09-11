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

        foreach ($categories as $category) {
            // Get only the latest submission per category
            $latestSubmission = FormSubmission::whereHas('form', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->with('form.category', 'form.formData', 'customer', 'files')
                ->latest()
                ->first();

            if ($latestSubmission) {
                // Map field values to latest form meta
                $fields = json_decode($latestSubmission->data, true) ?? [];
                $formFields = collect(data_get($latestSubmission, 'form.formData.fields', []));
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

                $latestSubmission->summaryFields = $summaryFields;
                $latestSubmission->category = $latestSubmission->form->category;

                $imageFile = collect($latestSubmission->files)->firstWhere('show_on_summary', true);
                $latestSubmission->imageFile = $imageFile;

                $submissionsByCategory[$category->id] = $latestSubmission;
                $allSubmissionsFlat[] = $latestSubmission;
            }
        }

        // Collection of latest submissions (one per category) for "All" tab
        $allSubmissions = collect($allSubmissionsFlat);

        $blogs = Blog::with('category')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('status', 'active')->get();

        return view('front.index', compact('categories', 'submissionsByCategory', 'allSubmissions', 'blogs', 'testimonials'));
    }



    public function addListing(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            $intendedUrl = 'add-listing';
            return redirect()->route('authentication-signup', ['redirect' => $intendedUrl]);
        }

        $customer = Auth::guard('customer')->user();
        $subscription = $customer->activeSubscription;

        // No active subscription → redirect to correct pricing page
        if (!$subscription) {
            if ($request->has('from') && $request->from === 'dashboard') {
                return redirect()->route(
                    'dashboard.subscription-plan',
                    [
                        'redirect' => 'add-listing',
                        'error' => 'Please purchase a subscription before creating a listing.'
                    ]
                );
            }

            return redirect()->route(
                'pricing',
                [
                    'redirect' => 'add-listing',
                    'error' => 'Please purchase a subscription before creating a listing.'
                ]
            );
        }

        // Check subscription usage
        $package = $subscription->package;
        if ($subscription->used_listings >= $package->listings) {
            if ($request->has('from') && $request->from === 'dashboard') {
                return redirect()->route(
                    'dashboard.subscription-plan',
                    [
                        'redirect' => 'add-listing',
                        'error' => 'Your subscription limit has been reached. Please upgrade.'
                    ]
                );
            }

            return redirect()->route(
                'pricing',
                [
                    'redirect' => 'add-listing',
                    'error' => 'Your subscription limit has been reached. Please upgrade.'
                ]
            );
        }

        // ✅ Load categories
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


    public function SubscriptionPlans()
    {
        // get all active packages
        $packages = \App\Models\Package::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.subscription-plan', compact('packages'));
    }
}
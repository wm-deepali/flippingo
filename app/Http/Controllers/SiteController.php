<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FormSubmission;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\HomeSlide;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\GoogleReviewsService;
use App\Services\TrustpilotService;


class SiteController extends Controller
{
    public function index(GoogleReviewsService $googleReviews, TrustpilotService $trustpilot)
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
                // ->whereNotNull('sponsor_display_until')
                // ->where('sponsor_display_until', '>', $now)
                ->with('form.category', 'form.formData', 'customer', 'files')
                ->where('status', 'published')
                ->latest()
                ->get();

            if ($sponsoredSubmissions->isNotEmpty()) {  // Only proceed if submissions exist
                $categorySubmissionCounts[$category->id] = $sponsoredSubmissions->count();

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
                    $files = collect($submission->files);

                    $submission->imageFile = $files->firstWhere('show_on_summary', true)
                        ?? $files->first()
                        ?? null;
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

        $testimonials = Testimonial::where('status', 'active')
            ->get();

        $countries = DB::table('countries')
            ->orderBy('name')
            ->get();

        $soldSubmissionIds = ProductOrder::pluck('submission_id')
            ->toArray();

        $heroCategories = Category::where('status', 'active')
            ->where('show_in_hero', 1)
            ->select('id', 'name', 'slug')
            ->get();

        $homeSlides = HomeSlide::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        // $reviews = $googleReviews->getReviews();
        // $trustpilotReviews = $trustpilot->getReviews();

        return view('front.index', compact('categories', 'submissionsByCategory', 'allSubmissions', 'blogs', 'testimonials', 'categorySubmissionCounts', 'countries', 'soldSubmissionIds', 'heroCategories', 'homeSlides'));
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



    public function FormSubmissionList(Request $request)
    {
        $categories = Category::where('status', 'active')
            ->with(['form.filters', 'form.formData'])
            ->get();

        $submissionsByCategory = [];
        $allSubmissionsFlat = [];

        foreach ($categories as $category) {
            // Fetch all submissions for the category
            $submissions = FormSubmission::whereHas('form', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })->with(['form.category', 'form.formData', 'customer', 'files'])
                ->where('status', 'published')
                ->get();

            // Apply filters using collection
            $filtered = $submissions->filter(function ($submission) use ($request) {
                $data = is_array($submission->data) ? $submission->data : json_decode($submission->data, true);

                // 🔍 Search filter
                if ($request->filled('search')) {
                    $search = strtolower($request->search);
                    $found = false;

                    foreach ($data as $field) {
                        if (!isset($field['value']))
                            continue;

                        $fieldValue = $field['value'];

                        if (is_array($fieldValue)) {
                            $fieldValue = implode(' ', array_map('strval', $fieldValue));
                        }

                        if (str_contains(strtolower($fieldValue), $search)) {
                            $found = true;
                            break;
                        }
                    }

                    if (!$found) {
                        return false;
                    }
                }

                // 💰 Price filters
                $mrp = floatval($data['mrp']['value'] ?? 0);
                if ($request->filled('price_min') && $mrp < $request->price_min)
                    return false;
                if ($request->filled('price_max') && $mrp > $request->price_max)
                    return false;

                // ⭐ Rating filter
                $rating = floatval($data['rating']['value'] ?? 0);
                if ($request->filled('rating') && $rating < $request->rating)
                    return false;

                // 🌍 Country filter
                if ($request->filled('country')) {
                    $customerCountry = optional($submission->customer)->country ?? null;
                    if (strtolower((string) $customerCountry) !== strtolower($request->country))
                        return false;
                }

                // 🏷️ For Sale filter
                if ($request->filled('for_sale')) {
                    $urgentSale = $data['urgent_sale']['value'] ?? 'No';
                    if (strtolower((string) $urgentSale) !== strtolower($request->for_sale))
                        return false;
                }

                // ⚙️ Dynamic filters
                if ($request->has('filters') && is_array($request->filters)) {
                    foreach ($request->filters as $field => $value) {
                        if (empty($value))
                            continue;

                        $fieldValue = $data[$field]['value'] ?? '';

                        // Handle array field values safely
                        if (is_array($fieldValue)) {
                            $fieldValue = implode(' ', array_map('strval', $fieldValue));
                        }

                        $fieldValue = strtolower((string) $fieldValue);

                        if (is_array($value)) {
                            $matches = collect($value)
                                ->map(fn($v) => strtolower((string) $v))
                                ->contains($fieldValue);

                            if (!$matches)
                                return false;
                        } else {
                            if ($fieldValue !== strtolower((string) $value))
                                return false;
                        }
                    }
                }

                return true;
            });



            // Map summary fields
            $allSubmissionsMapped = $filtered->map(function ($submission) {
                // Decode safely
                $fields = $submission->data;
                if (!is_array($fields)) {
                    $fields = json_decode($fields, true);
                }

                // Ensure array
                $fields = is_array($fields) ? $fields : [];

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
                $files = collect($submission->files);

                $submission->imageFile = $files->firstWhere('show_on_summary', true)
                    ?? $files->first()
                    ?? null;

                return $submission;
            });


            if ($allSubmissionsMapped->isNotEmpty()) {
                $submissionsByCategory[$category->id] = $allSubmissionsMapped;
                $allSubmissionsFlat = array_merge($allSubmissionsFlat, $allSubmissionsMapped->toArray());
            }

            // Prepare frontend filters
            $filterKeys = $category->form ? $category->form->filters->pluck('field_key')->toArray() : [];
            $cleanOptions = fn($options) => collect($options)->map(fn($o) => preg_replace('/\|selected$/', '', $o))->toArray();
            $category->filters = collect(data_get($category, 'form.formData.fields', []))
                ->filter(fn($f) => in_array(($f['properties']['id'] ?? $f['id']) ?? '', $filterKeys))
                ->map(function ($field) use ($cleanOptions) {
                    $type = $field['type'] ?? '';
                    $options = match ($type) {
                        'radio' => $cleanOptions($field['properties']['radios'] ?? []),
                        'checkbox' => $cleanOptions($field['properties']['checkboxes'] ?? []),
                        default => $cleanOptions($field['properties']['options'] ?? []),
                    };
                    return [
                        'field_id' => $field['properties']['id'] ?? $field['id'],
                        'label' => $field['properties']['label'] ?? '',
                        'type' => $type,
                        'options' => $options,
                    ];
                })->values();
        }

        $allSubmissions = collect($allSubmissionsFlat);

        // Apply global sorting here
        $sort = $request->input('sort', 'default');

        $allSubmissions = match ($sort) {
            'price-low-to-high' => $allSubmissions->sortBy(fn($s) => floatval(data_get(json_decode($s['data'] ?? '[]', true), 'mrp.value', 0))),
            'price-high-to-low' => $allSubmissions->sortByDesc(fn($s) => floatval(data_get(json_decode($s['data'] ?? '[]', true), 'mrp.value', 0))),
            'most-rated' => $allSubmissions->sortByDesc(fn($s) => floatval(data_get(json_decode($s['data'] ?? '[]', true), 'rating.value', 0))),
            'most-popular' => $allSubmissions->sortByDesc(fn($s) => $s['total_views'] ?? 0),
            'new-first' => $allSubmissions->sortByDesc(fn($s) => $s['created_at']),
            default => $allSubmissions->sortByDesc(fn($s) => $s['created_at']),
        };

        $countries = DB::table('countries')->orderBy('name')->get();
        // ✅ Fetch all sold submission IDs
        $soldSubmissionIds = \App\Models\ProductOrder::pluck('submission_id')->toArray();

        if ($request->ajax()) {
            // Prepare the partial view only with the filtered results
            $html = view('front.partials.filtered-listings', compact('submissionsByCategory', 'allSubmissions', 'soldSubmissionIds', 'categories'))->render();
            return response()->json(['html' => $html]);
        }


        return view('front.listing-list', compact(
            'categories',
            'submissionsByCategory',
            'allSubmissions',
            'countries',
            'soldSubmissionIds'
        ));
    }

}
<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\FormSubmission;
use App\Models\Category;
use App\Models\FormSummaryCard;
use App\Models\Testimonial;
use App\Models\HomeSlide;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\GoogleReviewsService;
use App\Services\TrustpilotService;
use App\Models\HomePageContent;
use App\Helpers\IpHelper;
use App\Helpers\CurrencyHelper;

class SiteController extends Controller
{

    public function index(GoogleReviewsService $googleReviews, TrustpilotService $trustpilot)
    {
        /* ======================================================
         | 🌍 IP BASED CURRENCY DETECTION
         ====================================================== */
        $countryCode = IpHelper::countryCode();
        // Currency logic
        $viewerCurrency = $countryCode === 'in' ? 'INR' : 'USD';
        // Exchange rate (base price assumed INR)
        $usdRate = CurrencyHelper::usdRate(); // REAL TIME

        $categories = Category::where('status', 'active')->get();
        $submissionsByCategory = [];
        $allSubmissionsFlat = [];
        $categorySubmissionCounts = [];
        $now = now();

        // 🔑 Preload all summary cards (performance safe)
        $formSummaryCards = FormSummaryCard::orderBy('position')
            ->get()
            ->groupBy('form_id');

        foreach ($categories as $category) {

            $submissions = FormSubmission::whereHas('form', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
                ->with(['form.category', 'form.formData', 'customer', 'files'])
                ->where('status', 'published')
                ->latest()
                ->get();

            if ($submissions->isEmpty()) {
                continue;
            }

            $categorySubmissionCounts[$category->id] = $submissions->count();

            $processedSubmissions = $submissions->map(function ($submission) use ($formSummaryCards, $viewerCurrency, $usdRate) {

                /* =====================================
                 | Decode submission data
                 ===================================== */
                $fields = is_array($submission->data)
                    ? $submission->data
                    : json_decode($submission->data, true);

                $fields = is_array($fields) ? $fields : [];

                /* =====================================
  | BASE PRICE FROM FORM
  ===================================== */
                $basePrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
                    ? ($fields['offered_price']['value'] ?? 0)
                    : ($fields['mrp']['value'] ?? 0);

                $basePrice = (float) $basePrice;

                /* =====================================
                 | SUBMISSION & VIEWER CURRENCY
                 ===================================== */
                $submissionCurrency = $submission->currency ?? 'USD'; // stored
                $displayPrice = $basePrice;
                /* =====================================
                 | CONVERSION MATRIX
                 ===================================== */
                if ($submissionCurrency === 'INR' && $viewerCurrency === 'USD') {
                    // INR → USD
                    $displayPrice = round($basePrice * $usdRate, 2);

                } elseif ($submissionCurrency === 'USD' && $viewerCurrency === 'INR') {
                    // USD → INR
                    $displayPrice = round($basePrice / $usdRate, 2);
                }

                // else: same currency → no conversion

                $submission->display_price = $displayPrice;
                $submission->currency = $viewerCurrency;
                $submission->currency_symbol = $viewerCurrency === 'INR' ? '₹' : '$';


                /* =====================================
                 | SUMMARY CARDS
                 ===================================== */
                $summaryCards = $formSummaryCards[$submission->form_id] ?? collect();
                $summaryFields = [];

                foreach ($summaryCards as $card) {
                    $key = $card->field_key;

                    if (!isset($fields[$key]['value'])) {
                        continue;
                    }

                    $value = $fields[$key]['value'];

                    if (is_array($value)) {
                        $value = implode(' ', array_map('strval', $value));
                    }

                    $summaryFields[] = [
                        'field_id' => $key,
                        'label' => $card->label,
                        'icon' => $card->icon,
                        'value' => $value,
                        'color' => $card->color,
                    ];
                }

                $submission->summaryFields = $summaryFields;

                /* =====================================
                 | FLAGS & META
                 ===================================== */
                $submission->category = $submission->form->category;
                $submission->is_verified = (bool) ($submission->customer->is_verified ?? false);
                $submission->is_premium = (bool) ($submission->customer->is_premium ?? false);

                /* =====================================
                 | IMAGES
                 ===================================== */
                $submission->allImages = collect($submission->files)->values()->map(function ($file) {
                    return [
                        'id' => $file->id,
                        'file_path' => $file->file_path,
                        'show_on_summary' => (bool) $file->show_on_summary,
                    ];
                });

                return $submission;
            });

            if ($processedSubmissions->isNotEmpty()) {
                $submissionsByCategory[$category->id] = $processedSubmissions;
                $allSubmissionsFlat = array_merge($allSubmissionsFlat, $processedSubmissions->toArray());
            }
        }

        $allSubmissions = collect($allSubmissionsFlat);

        /* ======================================================
         | OTHER DATA
         ====================================================== */
        $blogs = Blog::with('category')
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('status', 'active')->get();

        $indiaId = config('app.india_country_id', 229);

        $countries = DB::table('countries')
            ->leftJoin('form_submissions', 'countries.id', '=', 'form_submissions.country_id')
            ->where(function ($query) use ($indiaId) {
                $query->whereNotNull('form_submissions.country_id')
                    ->orWhere('countries.id', $indiaId);
            })
            ->select('countries.*')
            ->distinct()
            ->orderBy('countries.name')
            ->get();


        $soldSubmissionIds = ProductOrder::pluck('submission_id')->toArray();

        $heroCategories = Category::where('status', 'active')
            ->where('show_in_hero', 1)
            ->select('id', 'name', 'slug')
            ->get();

        $homeSlides = HomeSlide::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $homePageContent = HomePageContent::whereIn('section_key', [
            'hero',
            'featured',
            'most_searched',
        ])->get()->keyBy('section_key');

        return view('front.index', compact(
            'categories',
            'submissionsByCategory',
            'allSubmissions',
            'blogs',
            'testimonials',
            'categorySubmissionCounts',
            'countries',
            'soldSubmissionIds',
            'heroCategories',
            'homeSlides',
            'homePageContent'
        ));
    }


    public function allCategories()
    {
        // All active categories
        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        // Count published listings per category
        $categorySubmissionCounts = FormSubmission::where('status', 'published')
            ->whereHas('form')
            ->get()
            ->groupBy(function ($submission) {
                return $submission->form->category_id;
            })
            ->map->count()
            ->toArray();

        // Featured section content
        $homePageContent = HomePageContent::whereIn('section_key', ['featured'])
            ->get()
            ->keyBy('section_key');

        return view('front.categories', compact(
            'categories',
            'categorySubmissionCounts',
            'homePageContent'
        ));
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

        $countries = DB::table('countries')->orderBy('name')->get();
        return view('front.add-listing', compact('categories', 'countries'));
    }


    public function FormSubmissionList(Request $request)
    {
        /* ======================================================
         | 🌍 IP BASED CURRENCY DETECTION
         ====================================================== */
        $countryCode = IpHelper::countryCode();
        $viewerCurrency = $countryCode === 'in' ? 'INR' : 'USD';
        $usdRate = CurrencyHelper::usdRate(); // realtime rate

        /* ======================================================
         | 📦 FETCH CATEGORIES
         ====================================================== */
        $categories = Category::where('status', 'active')
            ->with(['form.filters', 'form.formData'])
            ->get();

        $submissionsByCategory = [];
        $allSubmissionsFlat = [];

        foreach ($categories as $category) {

            /* ======================================================
             | 📄 FETCH SUBMISSIONS
             ====================================================== */
            $submissions = FormSubmission::whereHas('form', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })
                ->with(['form.category', 'form.formData', 'customer', 'files', 'country'])
                ->where('status', 'published')
                ->get();

            /* ======================================================
             | 🔍 FILTERING
             ====================================================== */
            $filtered = $submissions->filter(function ($submission) use ($request, $viewerCurrency, $usdRate) {

                $data = is_array($submission->data)
                    ? $submission->data
                    : json_decode($submission->data, true);

                $data = is_array($data) ? $data : [];

                /* 🔍 SEARCH */
                if ($request->filled('search')) {
                    $search = strtolower($request->search);
                    $found = false;

                    foreach ($data as $field) {
                        if (!isset($field['value']))
                            continue;

                        $value = is_array($field['value'])
                            ? implode(' ', array_map('strval', $field['value']))
                            : $field['value'];

                        if (str_contains(strtolower((string) $value), $search)) {
                            $found = true;
                            break;
                        }
                    }

                    if (!$found)
                        return false;
                }

                /* 💰 PRICE (VIEWER CURRENCY) */
                $basePrice = ($data['urgent_sale']['value'] ?? '') === 'Yes'
                    ? ($data['offered_price']['value'] ?? 0)
                    : ($data['mrp']['value'] ?? 0);

                $basePrice = (float) $basePrice;
                $submissionCurrency = $submission->currency ?? 'INR';

                if ($submissionCurrency === 'INR' && $viewerCurrency === 'USD') {
                    $priceForViewer = round($basePrice * $usdRate, 2);
                } elseif ($submissionCurrency === 'USD' && $viewerCurrency === 'INR') {
                    $priceForViewer = round($basePrice / $usdRate, 2);
                } else {
                    $priceForViewer = $basePrice;
                }

                if ($request->filled('price_min') && $priceForViewer < $request->price_min)
                    return false;
                if ($request->filled('price_max') && $priceForViewer > $request->price_max)
                    return false;

                /* 🌍 COUNTRY */
                if ($request->filled('country')) {
                    $listingCountry = optional($submission->country)->name;
                    if (strtolower((string) $listingCountry) !== strtolower($request->country)) {
                        return false;
                    }
                }

                /* ⚡ FOR SALE */
                if ($request->filled('for_sale')) {
                    $urgentSale = $data['urgent_sale']['value'] ?? 'No';
                    if (strtolower($urgentSale) !== strtolower($request->for_sale)) {
                        return false;
                    }
                }

                /* ⚙️ DYNAMIC FILTERS */
                if ($request->has('filters') && is_array($request->filters)) {
                    foreach ($request->filters as $field => $value) {
                        if (empty($value))
                            continue;

                        $fieldValue = $data[$field]['value'] ?? '';

                        if (is_array($fieldValue)) {
                            $fieldValue = implode(' ', array_map('strval', $fieldValue));
                        }

                        if (is_array($value)) {
                            if (!in_array(strtolower($fieldValue), array_map('strtolower', $value))) {
                                return false;
                            }
                        } else {
                            if (strtolower($fieldValue) !== strtolower($value)) {
                                return false;
                            }
                        }
                    }
                }

                return true;
            });

            /* ======================================================
             | 🧮 MAP DISPLAY PRICE
             ====================================================== */
            $mapped = $filtered->map(function ($submission) use ($viewerCurrency, $usdRate) {

                $fields = is_array($submission->data)
                    ? $submission->data
                    : json_decode($submission->data, true);

                $fields = is_array($fields) ? $fields : [];

                $basePrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
                    ? ($fields['offered_price']['value'] ?? 0)
                    : ($fields['mrp']['value'] ?? 0);

                $basePrice = (float) $basePrice;
                $submissionCurrency = $submission->currency ?? 'INR';

                if ($submissionCurrency === 'INR' && $viewerCurrency === 'USD') {
                    $displayPrice = round($basePrice * $usdRate, 2);
                } elseif ($submissionCurrency === 'USD' && $viewerCurrency === 'INR') {
                    $displayPrice = round($basePrice / $usdRate, 2);
                } else {
                    $displayPrice = $basePrice;
                }

                // else: same currency → no conversion

                $submission->display_price = $displayPrice;
                $submission->currency = $viewerCurrency;
                $submission->currency_symbol = $viewerCurrency === 'INR' ? '₹' : '$';

                $summaryCards = FormSummaryCard::where('form_id', $submission->form_id)
                    ->orderBy('position')
                    ->get();

                $summaryFields = [];

                foreach ($summaryCards as $card) {
                    $fieldKey = $card->field_key;

                    if (!isset($fields[$fieldKey])) {
                        continue; // field removed after submission
                    }

                    $value = $fields[$fieldKey]['value'] ?? null;

                    if (is_array($value)) {
                        $value = implode(', ', array_map('strval', $value));
                    }

                    if ($value === null || $value === '') {
                        continue;
                    }

                    $summaryFields[] = [
                        'field_id' => $fieldKey,
                        'label' => $card->label,
                        'icon' => $card->icon,
                        'value' => $value,
                        'color' => $card->color,
                    ];
                }
                $submission->summaryFields = $summaryFields;

                $submission->category = $submission->form->category;
                $files = collect($submission->files);

                $submission->imageFile = $files->firstWhere('show_on_summary', true)
                    ?? $files->first()
                    ?? null;

                return $submission;
            });

            if ($mapped->isNotEmpty()) {
                $submissionsByCategory[$category->id] = $mapped;
                $allSubmissionsFlat = array_merge($allSubmissionsFlat, $mapped->toArray());
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

        $sort = $request->input('sort', 'default');

        $allSubmissions = match ($sort) {
            'price-low-to-high' => $allSubmissions->sortBy('viewer_price'),
            'price-high-to-low' => $allSubmissions->sortByDesc('viewer_price'),
            'most-rated' => $allSubmissions->sortByDesc(fn($s) => floatval(data_get(json_decode($s['data'], true), 'rating.value', 0))),
            'most-popular' => $allSubmissions->sortByDesc(fn($s) => $s['total_views'] ?? 0),
            'new-first' => $allSubmissions->sortByDesc('created_at'),
            default => $allSubmissions->sortByDesc('created_at'),
        };

        /* ======================================================
         | 🌍 COUNTRIES (ONLY USED + INDIA)
         ====================================================== */
        $usedCountryIds = FormSubmission::whereNotNull('country_id')
            ->pluck('country_id')
            ->unique()
            ->toArray();

        $countries = DB::table('countries')
            ->whereIn('id', array_unique(array_merge($usedCountryIds, [229]))) // 229 = India
            ->orderBy('name')
            ->get();

        $soldSubmissionIds = \App\Models\ProductOrder::pluck('submission_id')->toArray();

        if ($request->ajax()) {
            $html = view(
                'front.partials.filtered-listings',
                compact('submissionsByCategory', 'allSubmissions', 'soldSubmissionIds', 'categories')
            )->render();

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
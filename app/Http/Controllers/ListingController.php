<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enquiry;
use App\Models\FormData;
use App\Models\FormSubmission;
use App\Models\Wishlist;
use App\Models\FormSubmissionStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FormSummaryCard;
use App\Models\ProductOrder;

class ListingController extends Controller
{

    public function index()
    {
        $user = auth('customer')->user();

        $allSubmissions = FormSubmission::with(
            'form.category',
            'customer',
            'files'
        )
            ->latest()
            ->get();

        $submissions = $allSubmissions->map(function ($submission) {

            // Decode submission data safely
            $fields = is_array($submission->data)
                ? $submission->data
                : json_decode($submission->data, true);

            $fields = is_array($fields) ? $fields : [];

            // ✅ Fetch summary cards (admin-defined)
            $summaryCards = FormSummaryCard::where('form_id', $submission->form_id)
                ->orderBy('position')
                ->get();

            $summaryFields = [];

            foreach ($summaryCards as $card) {
                $key = $card->field_key;

                if (!isset($fields[$key])) {
                    continue; // field removed after submission
                }

                $value = $fields[$key]['value'] ?? null;

                if (is_array($value)) {
                    $value = implode(', ', array_map('strval', $value));
                }

                if ($value === null || $value === '') {
                    continue;
                }

                $summaryFields[] = [
                    'field_id' => $key,
                    'label' => $card->label,
                    'icon' => $card->icon,
                    'value' => $value,
                ];
            }

            // Attach computed data
            $submission->summaryFields = $summaryFields;

            $submission->is_sold = ProductOrder::where('submission_id', $submission->id)->exists();

            return $submission;
        });

        // Summary counts
        $summary = [
            'published' => $allSubmissions->where('status', 'published')->count(),
            'pending' => $allSubmissions->where('status', 'pending')->count(),
            'rejected' => $allSubmissions->where('status', 'rejected')->count(),
            'expired' => $allSubmissions->where('status', 'expired')->count(),
        ];

        return view('user.listing.index', compact('submissions', 'summary'));
    }


    public function apiShow(Request $request)
    {
        $id = $request->get('id');
        $user = auth('customer')->user();

        $submission = FormSubmission::with([
            'form.category',
            'customer.wallet',
            'files'
        ])->findOrFail($id);

        /* ==============================
         | VIEW + CLICK TRACKING
         |==============================*/
        if ($user) {
            $today = now()->toDateString();

            // Lifetime
            $submission->increment('total_views');
            $submission->increment('total_clicks');

            // Daily
            $stat = FormSubmissionStat::firstOrCreate(
                [
                    'form_submission_id' => $submission->id,
                    'date' => $today
                ],
                [
                    'views' => 0,
                    'clicks' => 0,
                    'unique_views' => 0
                ]
            );

            $stat->increment('views');
            $stat->increment('clicks');

            // Unique views
            $ip = $request->ip();
            $hasViewed = \App\Models\FormSubmissionView::where('form_submission_id', $id)
                ->where('ip_address', $ip)
                ->where('view_date', $today)
                ->exists();

            if (!$hasViewed) {
                \App\Models\FormSubmissionView::create([
                    'form_submission_id' => $submission->id,
                    'customer_id' => $user->id,
                    'ip_address' => $ip,
                    'view_date' => $today,
                ]);

                $submission->increment('unique_views');
                $stat->increment('unique_views');
            }
        }

        /* ==============================
         | FORM DATA
         |==============================*/
        $formData = \App\Models\FormData::where('form_id', $submission->form_id)->first();

        $layout = $formData->field_layout ?? [];
        $fields = $formData->fields ?? [];

        $submittedData = json_decode($submission->data, true) ?? [];

        /* ==============================
         | SUMMARY FIELDS (FROM SUMMARY CARDS)
         |==============================*/
        $summaryCards = \App\Models\FormSummaryCard::where('form_id', $submission->form_id)
            ->orderBy('position')
            ->get();

        $summaryFields = [];

        foreach ($summaryCards as $card) {

            $fieldKey = $card->field_key;

            if (!isset($submittedData[$fieldKey]['value'])) {
                continue; // field removed or not submitted
            }

            $value = $submittedData[$fieldKey]['value'];

            if (is_array($value)) {
                $value = implode(' ', array_map('strval', $value));
            }

            $summaryFields[] = [
                'field_id' => $fieldKey,
                'label' => $card->label,
                'icon' => $card->icon,
                'value' => $value,
            ];
        }

        /* ==============================
         | WALLET + WISHLIST
         |==============================*/
        $walletBalance = optional($submission->customer->wallet)->balance ?? 0;

        $isInWishlist = false;
        if ($user) {
            $isInWishlist = \App\Models\Wishlist::where('customer_id', $user->id)
                ->where('submission_id', $submission->id)
                ->exists();
        }

        /* ==============================
         | OTHER SUBMISSIONS (SAME SELLER)
         |==============================*/
        $otherSubmissions = FormSubmission::with('files')
            ->where('customer_id', $submission->customer_id)
            ->where('id', '!=', $submission->id)
            ->latest()
            ->take(6)
            ->get();

        /* ==============================
         | SOLD STATUS
         |==============================*/
        $soldSubmissionIds = \App\Models\ProductOrder::pluck('submission_id')->toArray();

        $isSold = in_array($submission->id, $soldSubmissionIds);

        /* ==============================
         | RETURN VIEW
         |==============================*/
        return view('front.listing-details', compact(
            'submission',
            'layout',
            'fields',
            'walletBalance',
            'summaryFields',
            'isInWishlist',
            'otherSubmissions',
            'isSold',
            'soldSubmissionIds'
        ));
    }


    public function sendEnquiry(Request $request)
    {
        $submissionId = $request->input('submission_id');
        $message = $request->input('message', '');

        $authCustomer = Auth::guard('customer')->user();
        if (!$authCustomer) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        if (!FormSubmission::where('id', $submissionId)->exists()) {
            return response()->json(['success' => false, 'message' => 'Invalid submission ID'], 400);
        }

        $formSubmission = FormSubmission::where('id', $submissionId)->first();
        Enquiry::create([
            'submission_id' => $submissionId,
            'customer_id' => $authCustomer->id,
            'message' => $message,
            'status' => 'pending',
        ]);

        sendNotification('new_enquiry', [
            'customer_name' => $authCustomer->first_name . ' ' . $authCustomer->last_name,
        ], $formSubmission->customer_id);

        return response()->json(['success' => true]);
    }

    public function apiIndex(Request $request)
    {
        $category = $request->query('category');

        if ($category && $category !== 'all') {
            $submissions = FormSubmission::whereHas('form', function ($q) use ($category) {
                $q->whereHas('category', function ($q2) use ($category) {
                    $q2->where('slug', $category);
                });
            })->with('form', 'customer')->paginate(10);
        } else {
            $submissions = FormSubmission::with('form', 'customer')->paginate(10);
        }

        return response()->json($submissions);
    }

    public function store(Request $request)
    {
        $customerId = Auth::guard('customer')->user()->id;
        $formId = $request->input('form_id');

        // Load form fields definition
        $formData = FormData::where('form_id', $formId)->first();
        $fieldsDefinition = $formData ? $formData->fields : [];

        // Get all non-file inputs except tokens and form_id
        $rawInputData = $request->except(['_token', '_method', 'form_id']);

        $inputDataWithMeta = [];

        foreach ($rawInputData as $fieldId => $value) {
            // Handle cascading dropdown child fields
            if (str_contains($fieldId, '_child') || str_contains($fieldId, '_child_custom')) {
                $parentFieldId = str_replace(['_child_custom', '_child'], '', $fieldId);

                if (isset($inputDataWithMeta[$parentFieldId])) {
                    // Assign both child and custom child values
                    if (str_contains($fieldId, '_child_custom')) {
                        $inputDataWithMeta[$parentFieldId]['child_custom_value'] = $value;
                    } else {
                        $inputDataWithMeta[$parentFieldId]['child_value'] = $value;
                    }
                } else {
                    $fieldDef = collect($fieldsDefinition)->firstWhere('id', $parentFieldId);
                    $fieldLabel = $fieldDef['properties']['label'] ?? $parentFieldId;
                    $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;
                    $icon = $fieldDef['properties']['icon'] ?? '';

                    $inputDataWithMeta[$parentFieldId] = [
                        'field_id' => $parentFieldId,
                        'label' => $fieldLabel,
                        'value' => null,
                        'child_value' => str_contains($fieldId, '_child_custom') ? null : $value,
                        'child_custom_value' => str_contains($fieldId, '_child_custom') ? $value : null,
                        'show_on_summary' => $showOnSummary,
                        'icon' => $icon,
                    ];
                }

                continue;
            }

            // Normal fields
            $fieldDef = collect($fieldsDefinition)->firstWhere('id', $fieldId);
            $fieldLabel = $fieldDef['properties']['label'] ?? $fieldId;
            $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;
            $icon = $fieldDef['properties']['icon'] ?? '';

            $inputDataWithMeta[$fieldId] = [
                'field_id' => $fieldId,
                'label' => $fieldLabel,
                'value' => $value,
                'show_on_summary' => $showOnSummary,
                'icon' => $icon,
            ];
        }

        // Handle uploaded files
        $uploadedFiles = [];
        foreach ($request->allFiles() as $fieldName => $fileOrFiles) {
            $fieldDef = collect($fieldsDefinition)->firstWhere('id', $fieldName);
            $fieldLabel = $fieldDef['properties']['label'] ?? $fieldName;
            $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;

            if (is_array($fileOrFiles) || $fileOrFiles instanceof \Illuminate\Support\Collection) {
                foreach ($fileOrFiles as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('uploads', 'public');
                        $uploadedFiles[] = [
                            'field_id' => $fieldName,
                            'field_label' => $fieldLabel,
                            'file_path' => $path,
                            'original_name' => $file->getClientOriginalName(),
                            'mime_type' => $file->getMimeType(),
                            'size' => $file->getSize(),
                            'show_on_summary' => $showOnSummary,
                        ];
                    }
                }
            } elseif ($fileOrFiles instanceof \Illuminate\Http\UploadedFile) {
                if ($fileOrFiles->isValid()) {
                    $path = $fileOrFiles->store('uploads', 'public');
                    $uploadedFiles[] = [
                        'field_id' => $fieldName,
                        'field_label' => $fieldLabel,
                        'file_path' => $path,
                        'original_name' => $fileOrFiles->getClientOriginalName(),
                        'mime_type' => $fileOrFiles->getMimeType(),
                        'size' => $fileOrFiles->getSize(),
                        'show_on_summary' => $showOnSummary,
                    ];
                }
            }

            // Remove from normal fields
            unset($inputDataWithMeta[$fieldName]);
        }

        // Subscription expiry & sponsor dates
        $customer = Auth::guard('customer')->user();
        $subscription = $customer->activeSubscription;

        $expiresAt = null;
        $sponsorDisplayUntil = null;
        if ($subscription && $subscription->package) {
            $package = $subscription->package;
            $expiresAt = now();

            switch ($package->listing_duration_unit) {
                case 'days':
                    $expiresAt->addDays($package->listing_duration);
                    break;
                case 'months':
                    $expiresAt->addMonths($package->listing_duration);
                    break;
                case 'years':
                    $expiresAt->addYears($package->listing_duration);
                    break;
                default:
                    $expiresAt->addDays($package->listing_duration);
            }

            if ($package->sponsored) {
                $frequency = $package->sponsored_frequency ?? 1;
                $unit = $package->sponsored_unit ?? 'days';
                $sponsorDisplayUntil = now()->copy()->add($unit, $frequency);
            }
        }

        // Save submission
        $submission = FormSubmission::create([
            'form_id' => $formId,
            'customer_id' => $customerId,
            'data' => json_encode($inputDataWithMeta, JSON_PRETTY_PRINT),
            'status' => 'pending',
            'expires_at' => $expiresAt,
            'sponsor_display_until' => $sponsorDisplayUntil,
        ]);

        // History
        $submission->addHistory('pending', 'Submission created', $customerId);

        // Save uploaded files
        foreach ($uploadedFiles as $fileData) {
            $submission->files()->create([
                'field_id' => $fileData['field_id'],
                'field_name' => $fileData['field_label'],
                'file_path' => $fileData['file_path'],
                'original_name' => $fileData['original_name'],
                'mime_type' => $fileData['mime_type'],
                'size' => $fileData['size'],
                'show_on_summary' => $fileData['show_on_summary'],
            ]);
        }

        // Update subscription usage
        if ($subscription) {
            $subscription->increment('used_listings');
        }

        return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
    }


    public function show($id)
    {
        $submission = FormSubmission::find($id);

        // Decode submitted data JSON (contains 'label', 'value', 'show_on_summary')
        $submittedData = json_decode($submission->data, true) ?? [];

        $mappedData = [];

        foreach ($submittedData as $fieldId => $fieldData) {
            $label = $fieldData['label'] ?? $fieldId;
            $value = $fieldData['value'] ?? null;
            $childValue = $fieldData['child_value'] ?? null; // <- add this
            $showOnSummary = $fieldData['show_on_summary'] ?? false;

            $mappedData[$label] = [
                'value' => $value,
                'child_value' => $childValue,   // <- include child_value here
                'child_custom_value' => $fieldData['child_custom_value'] ?? null,
                'show_on_summary' => $showOnSummary,
            ];
        }
        return view('user.listing.show', compact('submission', 'mappedData'));
    }

    public function edit($id)
    {
        $submission = FormSubmission::findOrFail($id);

        // Load FormData linked to this submission's form
        $formData = FormData::where('form_id', $submission->form_id)->first();

        $existingData = json_decode($submission->data, true) ?? [];
        $uploadedFiles = $submission->files;

        // dd($formData->fields);
        return view('user.listing.edit', [
            'submission' => $submission,
            'formData' => $formData,
            'existingData' => $existingData,
            'uploadedFiles' => $uploadedFiles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $submission = FormSubmission::with('form')->find($id);

        try {
            $form = $submission->form;
            if (!$form) {
                return response()->json([
                    'success' => false,
                    'message' => 'Form not found.'
                ], 404);
            }

            $formData = FormData::where('form_id', $form->id)->first();
            $fieldsDefinition = $formData ? $formData->fields : [];

            // Existing structured input data
            $inputDataWithMeta = $submission->data ? json_decode($submission->data, true) : [];

            // Update non-file fields
            $rawInputData = $request->except(['_token', '_method', 'form_id', 'delete_files']);
            foreach ($rawInputData as $fieldId => $value) {
                // Handle child fields of cascading dropdowns
                if (str_ends_with($fieldId, '_child')) {
                    $parentKey = str_replace('_child', '', $fieldId);
                    $inputDataWithMeta[$parentKey]['child_value'] = $value;
                    continue;
                }

                // Handle "Other" custom input for cascading dropdowns
                if (str_ends_with($fieldId, '_child_custom')) {
                    $parentKey = str_replace('_child_custom', '', $fieldId);
                    $inputDataWithMeta[$parentKey]['child_custom_value'] = $value;
                    continue;
                }


                $fieldDef = collect($fieldsDefinition)->firstWhere('id', $fieldId);
                $fieldLabel = $fieldDef['properties']['label'] ?? $fieldId;
                $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;
                $icon = $fieldDef['properties']['icon'] ?? '';

                $inputDataWithMeta[$fieldId] = [
                    'field_id' => $fieldId,
                    'label' => $fieldLabel,
                    'value' => $value,
                    'show_on_summary' => $showOnSummary,
                    'icon' => $icon,
                ];
            }

            // Handle file deletions
            if ($request->has('delete_files')) {
                foreach ($request->delete_files as $fileId) {
                    $file = $submission->files()->find($fileId);
                    if ($file) {
                        Storage::disk('public')->delete($file->file_path);
                        $file->delete();
                    }
                }
            }

            // Handle new file uploads (replace old ones for same field)
            foreach ($request->allFiles() as $fieldName => $fileOrFiles) {
                $fieldDef = collect($fieldsDefinition)
                    ->firstWhere('id', $fieldName)
                    ?? collect($fieldsDefinition)->firstWhere('name', $fieldName);

                $fieldLabel = $fieldDef['properties']['label'] ?? $fieldName;
                $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;

                // 🚨 delete old files for this field (if any)
                $oldFiles = $submission->files()->where('field_id', $fieldName)->get();
                foreach ($oldFiles as $oldFile) {
                    Storage::disk('public')->delete($oldFile->file_path);
                    $oldFile->delete();
                }

                // Save new file(s)
                if (is_array($fileOrFiles)) {
                    foreach ($fileOrFiles as $file) {
                        if ($file->isValid()) {
                            $path = $file->store('uploads', 'public');
                            $submission->files()->create([
                                'field_id' => $fieldName,
                                'field_name' => $fieldLabel,
                                'file_path' => $path,
                                'original_name' => $file->getClientOriginalName(),
                                'mime_type' => $file->getMimeType(),
                                'size' => $file->getSize(),
                                'show_on_summary' => $showOnSummary,
                            ]);
                        }
                    }
                } elseif ($fileOrFiles instanceof \Illuminate\Http\UploadedFile) {
                    if ($fileOrFiles->isValid()) {
                        $path = $fileOrFiles->store('uploads', 'public');
                        $submission->files()->create([
                            'field_id' => $fieldName,
                            'field_name' => $fieldLabel,
                            'file_path' => $path,
                            'original_name' => $fileOrFiles->getClientOriginalName(),
                            'mime_type' => $fileOrFiles->getMimeType(),
                            'size' => $fileOrFiles->getSize(),
                            'show_on_summary' => $showOnSummary,
                        ]);
                    }
                }

                unset($inputDataWithMeta[$fieldName]); // avoid JSON conflict
            }


            // Update submission
            $submission->update([
                'data' => json_encode($inputDataWithMeta),
            ]);

            $user = auth('customer')->user();
            $submission->addHistory($submission->status, 'Submission updated', $user->id);

            return response()->json([
                'success' => true,
                'message' => 'Submission updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $submission = FormSubmission::findOrFail($id);

        // delete related files, dependencies, etc.
        $submission->files()->delete();
        // add any cascading deletes you need for related models

        $submission->delete();

        return response()->json(['success' => true, 'message' => 'Listing and all related data deleted successfully.']);
    }


    public function enquiryIndex(Request $request)
    {
        $user = auth('customer')->user();

        $query = Enquiry::with('customer', 'submission.form')
            ->where(function ($q) use ($user) {
                // 🟢 Case 1: I am the buyer (I enquired)
                $q->where('customer_id', $user->id)

                    // 🟢 Case 2: I am the seller (enquiries on my listings)
                    ->orWhereHas('submission', function ($subQ) use ($user) {
                    $subQ->where('customer_id', $user->id);
                });
            });

        // 🔹 Filter by Business Category
        if ($request->filled('business_category')) {
            $query->whereHas('submission.form', function ($q) use ($request) {
                $q->where('category_id', $request->business_category);
            });
        }

        // 🔹 Filter by Listing
        if ($request->filled('submission_id')) {
            $query->where('submission_id', $request->submission_id);
        }

        // 🔹 Date Range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // 🔹 Sorting
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $enquiries = $query->paginate(20)->appends($request->query());

        // Totals
        $totalEnquiries = (clone $query)->count();
        $totalCustomers = (clone $query)->distinct('customer_id')->count('customer_id');

        // For filters
        $businessCategories = Category::all();
        $submissionsList = FormSubmission::with('form')
            ->where('customer_id', $user->id) // only their listings
            ->get();

        return view('user.enquiries', compact(
            'enquiries',
            'totalEnquiries',
            'totalCustomers',
            'businessCategories',
            'submissionsList'
        ));
    }


    public function wishlistIndex()
    {
        $user = auth('customer')->user();

        // Get wishlist items with related submission + form + files + customer
        $wishlist = Wishlist::with(
            'submission.form.category',
            'submission.customer',
            'submission.files'
        )
            ->where('customer_id', $user->id)
            ->latest()
            ->paginate(20);

        foreach ($wishlist as $item) {
            $submission = $item->submission;

            if (!$submission) {
                continue;
            }

            // Decode submission data safely
            $fields = is_array($submission->data)
                ? $submission->data
                : json_decode($submission->data, true);

            $fields = is_array($fields) ? $fields : [];

            // ✅ Fetch admin-defined summary cards
            $summaryCards = FormSummaryCard::where('form_id', $submission->form_id)
                ->orderBy('position')
                ->get();

            $summaryFields = [];

            foreach ($summaryCards as $card) {
                $key = $card->field_key;

                if (!isset($fields[$key])) {
                    continue; // field removed after submission
                }

                $value = $fields[$key]['value'] ?? null;

                if (is_array($value)) {
                    $value = implode(', ', array_map('strval', $value));
                }

                if ($value === null || $value === '') {
                    continue;
                }

                $summaryFields[] = [
                    'field_id' => $key,
                    'label' => $card->label,
                    'icon' => $card->icon,
                    'value' => $value,
                ];
            }

            // Attach for Blade usage
            $submission->summaryFields = $summaryFields;
            $submission->category = $submission->form->category;

            // Image handling
            $submission->imageFile = collect($submission->files)
                ->firstWhere('show_on_summary', true)
                ?? $submission->files->first();
        }

        return view('user.wishlist', compact('wishlist'));
    }

    public function SubmissionList(Request $request)
    {
        $customerId = auth('customer')->id();
        $now = now();

        // Fetch categories
        $categories = Category::orderBy('name')->get();

        // Filters
        $filter = $request->query('filter', 'all'); // today / seven-day / etc.
        $categoryFilter = $request->query('category');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $sort = $request->query('sort'); // Maximum Views / Maximum Clicks / Recent First

        // Base query: all submissions of the customer
        $query = FormSubmission::where('customer_id', $customerId)
            ->with(['form.category', 'customer']);

        // Category filter
        if ($categoryFilter) {
            $query->whereHas('form.category', fn($q) => $q->where('name', $categoryFilter));
        }

        // Date range filter on submissions (optional)
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->where('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        $submissions = $query->paginate(20);
        $submissionIds = $submissions->pluck('id')->toArray();

        // Determine period for stats (skip for 'all')
        $statsFrom = null;
        $statsTo = null;
        if ($filter !== 'all') {
            if ($filter === 'today') {
                $statsFrom = $statsTo = $now->toDateString();
            } elseif ($filter === 'seven-day') {
                $statsFrom = $now->copy()->subDays(7)->toDateString();
                $statsTo = $now->toDateString();
            } elseif ($filter === 'fifteen-day') {
                $statsFrom = $now->copy()->subDays(15)->toDateString();
                $statsTo = $now->toDateString();
            } elseif ($filter === 'thirty-day') {
                $statsFrom = $now->copy()->subDays(30)->toDateString();
                $statsTo = $now->toDateString();
            }
        }

        // Aggregate stats
        $statsQuery = \App\Models\FormSubmissionStat::selectRaw('form_submission_id')
            ->selectRaw('SUM(views) as views')
            ->selectRaw('SUM(clicks) as clicks')
            ->selectRaw('SUM(unique_views) as unique_views')
            ->whereIn('form_submission_id', $submissionIds);

        // Apply period filter only if not "all"
        if ($statsFrom && $statsTo) {
            $statsQuery->whereBetween('date', [$statsFrom, $statsTo]);
        }

        $stats = $statsQuery->groupBy('form_submission_id')
            ->get()
            ->keyBy('form_submission_id');

        // Attach stats to submissions
        $submissions->getCollection()->transform(function ($submission) use ($stats) {
            $s = $stats[$submission->id] ?? null;
            $submission->views = $s->views ?? 0;
            $submission->clicks = $s->clicks ?? 0;
            $submission->unique = $s->unique_views ?? 0;
            return $submission;
        });

        // Summary stats
        $totalClicks = $submissions->sum('clicks');
        $totalViews = $submissions->sum('views');
        $uniqueViews = $submissions->sum('unique');

        $firstSubmission = $submissions->sortBy('created_at')->first();
        $daysActive = $firstSubmission ? $firstSubmission->created_at->diffInDays(now()) : 1;
        $estimatedTraffic = $daysActive ? round($totalViews / $daysActive) : 0;

        return view('user.analytics', compact(
            'categories',
            'submissions',
            'totalClicks',
            'totalViews',
            'uniqueViews',
            'estimatedTraffic',
            'filter',
            'categoryFilter',
            'startDate',
            'endDate',
            'sort'
        ));
    }

    public function analytics($id)
    {
        $submission = FormSubmission::with(['form.category', 'customer'])->findOrFail($id);

        $now = now();
        $start = $now->copy()->subDays(30);

        // Use FormSubmissionStat for aggregated stats per day
        $chartData = \App\Models\FormSubmissionStat::where('form_submission_id', $id)
            ->whereBetween('date', [$start->toDateString(), $now->toDateString()])
            ->orderBy('date')
            ->get()
            ->keyBy(fn($item) => $item->date);

        $chartLabels = [];
        $chartViews = [];
        $chartClicks = [];
        $chartUniques = [];

        // Fill missing days with 0
        for ($date = $start->copy(); $date->lte($now); $date->addDay()) {
            $d = $date->toDateString();
            $chartLabels[] = $date->format('d M');
            $chartViews[] = $chartData[$d]->views ?? 0;
            $chartClicks[] = $chartData[$d]->clicks ?? 0;
            $chartUniques[] = $chartData[$d]->unique_views ?? 0;
        }

        return view('user.analytics-detail', compact(
            'submission',
            'chartLabels',
            'chartViews',
            'chartClicks',
            'chartUniques'
        ));
    }

    public function search(Request $request)
    {
        $search = strtolower(trim($request->q));

        if (!$search || strlen($search) < 2) {
            return response()->json([
                'type' => 'empty',
                'message' => 'Type at least 2 characters to search',
                'data' => []
            ]);
        }

        /* =========================
         | SEARCH LISTINGS
         |========================= */
        $listings = FormSubmission::with([
            'customer.activeSubscription.package',
            'files',
            'form.category'
        ])
            ->where('status', 'published')
            ->get()
            ->filter(function ($submission) use ($search) {

                // ✅ SAME DATA HANDLING
                $data = is_array($submission->data)
                    ? $submission->data
                    : json_decode($submission->data, true);

                if (!is_array($data)) {
                    return false;
                }

                // ✅ EXACT SAME SEARCH LOGIC YOU PROVIDED
                $found = false;

                foreach ($data as $field) {
                    if (!isset($field['value'])) {
                        continue;
                    }

                    $fieldValue = $field['value'];

                    if (is_array($fieldValue)) {
                        $fieldValue = implode(' ', array_map('strval', $fieldValue));
                    }

                    if (str_contains(strtolower((string) $fieldValue), $search)) {
                        $found = true;
                        break;
                    }
                }

                return $found;
            })
            ->take(5)
            ->map(function ($s) {

                // Prepare data safely
                $data = is_array($s->data)
                    ? $s->data
                    : json_decode($s->data, true);

                // 🔑 Dynamically derive title from form data
                $title = 'Listing';

                if (is_array($data)) {
                    foreach ($data as $field) {
                        if (!is_array($field) || !isset($field['value'])) {
                            continue;
                        }

                        $value = $field['value'];

                        if (is_array($value)) {
                            $value = implode(' ', array_map('strval', $value));
                        }

                        $value = trim((string) $value);

                        // take first meaningful text as title
                        if ($value !== '' && strlen($value) > 2) {
                            $title = $value;
                            break;
                        }
                    }
                }

                // Image logic (unchanged)
                $files = collect($s->files);
                $imageFile = $files->firstWhere('show_on_summary', true)
                    ?? $files->first()
                    ?? null;

                return [
                    'type' => 'listing',
                    'id' => $s->id,
                    'title' => $title,
                    'url' => route('listing-details', ['id' => $s->id]),
                    'seller' => $s->customer?->name,
                    'is_verified' => $s->customer?->is_verified_seller ?? false,
                    'is_premium' => $s->customer?->is_premium_seller ?? false,
                    'image' => $imageFile?->file_path
                ];
            });

        /* =========================
         | SEARCH CATEGORIES
         |========================= */
        $categories = Category::whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
            ->take(5)
            ->get()
            ->map(fn($c) => [
                'type' => 'category',
                'id' => $c->id,
                'title' => $c->name,
                'url' => url('/listing-list') . '?category=' . $c->slug,
                'image' => $c->image ?? null
            ]);

        /* =========================
         | MERGE RESULTS
         |========================= */
        $results = $categories
            ->toBase()   // 👈 converts Eloquent\Collection → Support\Collection
            ->merge($listings)
            ->take(8)
            ->values();

        if ($results->isEmpty()) {
            return response()->json([
                'type' => 'not_found',
                'message' => 'No results found',
                'data' => []
            ]);
        }

        return response()->json([
            'type' => 'search',
            'data' => $results
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enquiry;
use App\Models\FormData;
use App\Models\FormSubmission;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index()
    {
        $user = auth('customer')->user();

        $allSubmissions = FormSubmission::with('form.category', 'form.formData', 'customer', 'files')
            ->latest()
            ->get();

        // Map each submission's field values to current form field meta
        $submissions = $allSubmissions->map(function ($submission) {
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
            return $submission;
        });

        // dd($submissions->toArray());
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

        // Fetch submission with relations
        $submission = FormSubmission::with(['form.category', 'customer.wallet', 'files'])
            ->findOrFail($id);

        if ($user) {
            // Track total views
            $submission->increment('total_views');
            $submission->increment('total_clicks');

            // Track unique views by customer ID
            $userId = $user->id;

            $hasViewed = \App\Models\FormSubmissionView::where('form_submission_id', $id)
                ->where('customer_id', $userId)
                ->exists();

            if (!$hasViewed) {
                \App\Models\FormSubmissionView::create([
                    'form_submission_id' => $id,
                    'customer_id' => $userId,
                    'ip_address' => $request->ip(),
                ]);

                $submission->increment('unique_views');
            }
        }
        // Else: no tracking if not logged in

        // Fetch form layout and fields
        $formData = \App\Models\FormData::where('form_id', $submission->form_id)->first();

        $layout = $formData && !empty($formData->field_layout) ? $formData->field_layout : [];
        $fields = $formData && !empty($formData->fields) ? $formData->fields : [];

        // Prepare summary fields to show
        $submittedData = json_decode($submission->data, true) ?? [];
        $formFields = collect($fields);

        $summaryFields = [];
        foreach ($submittedData as $field_id => $field) {
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

        $walletBalance = optional($submission->customer->wallet)->balance ?? 0;

        $isInWishlist = false;
        if ($user) {
            $isInWishlist = \App\Models\Wishlist::where('customer_id', $user->id)
                ->where('submission_id', $submission->id)
                ->exists();
        }

        return view('front.listing-details', compact(
            'submission',
            'layout',
            'fields',
            'walletBalance',
            'summaryFields',
            'isInWishlist'
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

        Enquiry::create([
            'submission_id' => $submissionId,
            'customer_id' => $authCustomer->id,
            'message' => $message,
            'status' => 'pending',
        ]);

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

        // Build structured input data with id, label, and value for each field
        $inputDataWithMeta = [];
        foreach ($rawInputData as $fieldId => $value) {
            $fieldDef = collect($fieldsDefinition)->firstWhere('id', $fieldId);
            $fieldLabel = $fieldDef['properties']['label'] ?? $fieldId;
            $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;
            $icon = $fieldDef['properties']['icon'] ?? '';  // fetch icon here

            $inputDataWithMeta[$fieldId] = [
                'field_id' => $fieldId,
                'label' => $fieldLabel,
                'value' => $value,
                'show_on_summary' => $showOnSummary,
                'icon' => $icon,
            ];
        }

        $uploadedFiles = [];

        foreach ($request->allFiles() as $fieldName => $fileOrFiles) {
            // Handle multiple files (array or collection)
            if (is_array($fileOrFiles) || $fileOrFiles instanceof \Illuminate\Support\Collection) {
                foreach ($fileOrFiles as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('uploads', 'public');
                        $fieldLabel = collect($fieldsDefinition)
                            ->firstWhere('id', $fieldName)['properties']['label'] ?? $fieldName;
                        $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;

                        $uploadedFiles[] = [
                            'field_id' => $fieldId,
                            'field_label' => $fieldLabel,
                            'file_path' => $path,
                            'original_name' => $file->getClientOriginalName(),
                            'mime_type' => $file->getMimeType(),
                            'size' => $file->getSize(),
                            'show_on_summary' => $showOnSummary,
                        ];
                    }
                }
            }
            // Handle single file upload
            elseif ($fileOrFiles instanceof \Illuminate\Http\UploadedFile) {
                if ($fileOrFiles->isValid()) {
                    $path = $fileOrFiles->store('uploads', 'public');
                    $fieldLabel = collect($fieldsDefinition)
                        ->firstWhere('id', $fieldName)['properties']['label'] ?? $fieldName;

                    $showOnSummary = $fieldDef['properties']['show_on_summary'] ?? false;

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

            // Remove file input from inputDataWithMeta to avoid JSON encoding issues
            unset($inputDataWithMeta[$fieldName]);
        }

        $customer = Auth::guard('customer')->user();
        $subscription = $customer->activeSubscription;

        $expiresAt = null;
        $sponsorDisplayUntil = null;
        if ($subscription && $subscription->package) {
            $package = $subscription->package;

            $expiresAt = now();
            switch ($package->listing_duration_unit) {
                case 'days':
                    $expiresAt = $expiresAt->addDays($package->listing_duration);
                    break;
                case 'months':
                    $expiresAt = $expiresAt->addMonths($package->listing_duration);
                    break;
                case 'years':
                    $expiresAt = $expiresAt->addYears($package->listing_duration);
                    break;
                default:
                    $expiresAt = $expiresAt->addDays($package->listing_duration);
            }

            if ($subscription->package->sponsored) {
                $frequency = $subscription->package->sponsored_frequency ?? 1;
                $unit = $subscription->package->sponsored_unit ?? 'days';

                $now = now();

                // Calculate sponsor display expiry: now + frequency in the specified unit
                $sponsorDisplayUntil = $now->copy()->add($unit, $frequency);
            }

        }

        $submission = FormSubmission::create([
            'form_id' => $formId,
            'customer_id' => $customerId,
            'data' => json_encode($inputDataWithMeta),
            'status' => 'pending', // initial status
            'expires_at' => $expiresAt,
            'sponsor_display_until' => $sponsorDisplayUntil,
        ]);


        // Log initial history
        $submission->addHistory('pending', 'Submission created', $customerId);

        // Save uploaded files details associated with this submission
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

        // **Update used_listings count on subscription**
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
            $showOnSummary = $fieldData['show_on_summary'] ?? false;

            $mappedData[$label] = [
                'value' => $value,
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
        $query = Enquiry::with('customer', 'submission.form');

        // 🔹 Filter by Business Category (via related form of submission)
        if ($request->filled('business_category')) {
            $query->whereHas('submission.form', function ($q) use ($request) {
                $q->where('category_id', $request->business_category);
            });
        }

        // 🔹 Filter by Listing (Show enquiries of a single submission if id is given)
        if ($request->filled('submission_id')) {
            $query->where('submission_id', $request->submission_id);
        }

        // 🔹 Date Range Filter
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

        // Totals (based on same query if submission_id is present, so counts match the filter)
        $totalEnquiries = $query->count();
        $totalCustomers = $query->distinct('customer_id')->count('customer_id');

        // For filters
        $businessCategories = Category::all();
        $submissionsList = FormSubmission::with('form')->get();

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
        $wishlist = Wishlist::with('submission.form.category', 'submission.form.formData', 'submission.customer', 'submission.files')
            ->where('customer_id', $user->id)
            ->latest()
            ->paginate(20);

        // 🔹 Map summary fields and image for each submission in wishlist
        foreach ($wishlist as $item) {
            $submission = $item->submission;

            if ($submission) {
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

                // Attach to model instance for easy use in Blade
                $submission->summaryFields = $summaryFields;
                $submission->category = $submission->form->category;

                $imageFile = collect($submission->files)->firstWhere('show_on_summary', true);
                $submission->imageFile = $imageFile;
            }
        }

        return view('user.wishlist', compact('wishlist'));
    }

    public function analytics(Request $request)
    {
        $customerId = auth('customer')->id();

        // Fetch all categories for filter dropdownz
        $categories = Category::orderBy('name')->get();

        $filter = $request->query('filter', 'all'); // tab filter
        $categoryFilter = $request->query('category');
        $startDate = $request->query('start_date');  // date from
        $endDate = $request->query('end_date');      // date to
        $sort = $request->query('sort');          // sorting option

        $query = FormSubmission::where('customer_id', $customerId);

        // Apply period filter (tabs)
        if ($filter === 'today') {
            $query->whereDate('created_at', now());
        } elseif ($filter === 'days7') {
            $query->where('created_at', '>=', now()->subDays(7));
        } elseif ($filter === 'days15') {
            $query->where('created_at', '>=', now()->subDays(15));
        } elseif ($filter === 'days30') {
            $query->where('created_at', '>=', now()->subDays(30));
        }

        // Apply category filter
        if ($categoryFilter) {
            // Assuming you have category_id in submissions or via relation filtering
            $query->whereHas('form.category', function ($q) use ($categoryFilter) {
                $q->where('name', $categoryFilter);
            });
        }

        // Apply date range filter
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->where('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        // Apply sorting
        if ($sort === 'Maximum Views') {
            $query->orderBy('total_views', 'desc');
        } elseif ($sort === 'Maximum Clicks') {
            $query->orderBy('total_clicks', 'desc');
        } elseif ($sort === 'Recent First') {
            $query->orderBy('created_at', 'desc');
        }

        $submissions = $query->with(['form.category', 'customer'])->paginate(20);

        // Calculate summary stats like before
        $totalClicks = $submissions->sum('total_clicks');
        $totalViews = $submissions->sum('total_views');
        $uniqueViews = $submissions->sum('unique_views');

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



}


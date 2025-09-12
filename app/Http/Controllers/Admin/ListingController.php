<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FormSubmission;

class ListingController extends Controller
{

    public function index()
    {
        $submissions = FormSubmission::with(['customer', 'form.category', 'orders'])
            ->latest()
            ->get();

        // Automatically expire submissions if past expires_at
        $submissions->each(function ($submission) {
            if ($submission->expires_at && \Carbon\Carbon::parse($submission->expires_at)->isPast()) {
                if ($submission->status !== 'expired') {
                    $submission->update(['status' => 'expired']);
                    $submission->addHistory('expired', 'Auto-updated due to expiry', $submission->customer_id);
                }
            }
        });

        // Map for front-end
        $submissions = $submissions->map(function ($submission) {
            $submittedValues = $submission ? json_decode($submission->data, true) : [];

            $submission->offered_price = $submittedValues['offered_price']['value'] ?? 0;
            $submission->product_title = $submittedValues['product_title']['value'] ?? '';
            $submission->category_name = optional($submission->form->category)->name ?? '';
            $submission->total_sales = $submission->orders->count();
            $submission->is_expired = $submission->status === 'expired';

            return $submission;
        });

        return view('admin.form_submissions.index', compact('submissions'));
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

        return view('admin.form_submissions.show', compact('submission', 'mappedData'));
    }

    public function store(Request $request)
    {
        $customerId = Auth::guard('customer')->user()->id;
        $formId = $request->input('form_id');

        // Load form fields definition
        $formData = \App\Models\FormData::where('form_id', $formId)->first();
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

        }

        $submission = FormSubmission::create([
            'form_id' => $formId,
            'customer_id' => $customerId,
            'data' => json_encode($inputDataWithMeta),
            'status' => 'pending', // initial status
            'expires_at' => $expiresAt,
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

        return response()->json(['success' => true, 'message' => 'Form submitted successfully']);
    }


    public function edit($id)
    {
        $submission = FormSubmission::findOrFail($id);

        // Load FormData linked to this submission's form
        $formData = \App\Models\FormData::where('form_id', $submission->form_id)->first();

        $existingData = json_decode($submission->data, true) ?? [];
        $uploadedFiles = $submission->files;

        // dd($formData->fields);
        return view('admin.form_submissions.edit', [
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

            $submission->addHistory($submission->status, 'Submission updated', auth()->id());

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



    public function updateStatus(Request $request, $id)
    {
        $submission = FormSubmission::findOrFail($id);

        $status = $request->input('status');

        $submission->status = $status;

        if ($status === 'rejected') {
            $submission->remarks = $request->input('remarks'); // Save remarks
        }

        $submission->save();

        // Optional: add history entry
        $submission->addHistory($status, $request->input('remarks'));

        return response()->json(['message' => 'Status updated successfully']);
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

    public function apiShow(Request $request)
    {
        $id = $request->get('id');
        $user = auth('customer')->user();

        // Fetch submission with relations, including wallet via customer.wallet
        $submission = FormSubmission::with(['form.category', 'customer.wallet', 'files'])->findOrFail($id);

        // Fetch FormData for layout and fields
        $formData = \App\Models\FormData::where('form_id', $submission->form_id)->first();

        $layout = $formData && !empty($formData->field_layout) ? $formData->field_layout : [];
        $fields = $formData && !empty($formData->fields) ? $formData->fields : [];

        // Prepare summaryFields with latest form field meta for the submission
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

        // Pass wallet balance separately if needed
        $walletBalance = optional($submission->customer->wallet)->balance ?? 0;

        // Check wishlist status if customer logged in
        $isInWishlist = false;
        if ($user) {
            $isInWishlist = \App\Models\Wishlist::where('customer_id', $user->id)
                ->where('submission_id', $submission->id)
                ->exists();
        }

        return view('front.listing-details', compact('submission', 'layout', 'fields', 'walletBalance', 'summaryFields', 'isInWishlist'));
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

    public function enquiryIndex()
    {
        $enquiries = Enquiry::with('customer', 'submission')->paginate(20);
        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function viewAllSales($submissionId)
    {
        $submission = FormSubmission::with(['customer', 'form.category', 'orders.customer', 'orders.seller', 'orders.payment', 'orders.currentStatus'])->findOrFail($submissionId);
        $submittedValues = $submission ? json_decode($submission->data, true) : [];

        $submission->offered_price = optional($submittedValues['offered_price'])['value'] ?? 0;
        $submission->product_title = optional($submittedValues['product_title'])['value'] ?? '';
        $submission->category_name = optional($submission->form->category)->name ?? '';
        $submission->total_sales = $submission->orders->count();

        $orders = $submission->orders;
        return view('admin.form_submissions.sales', compact('submission', 'orders'));
    }

}

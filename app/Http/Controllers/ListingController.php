<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('user.listing', compact('submissions', 'summary'));
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
}

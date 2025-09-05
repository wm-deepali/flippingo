<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FormSubmission;

class ListingController extends Controller
{

    public function index()
    {
        // Fetch all submissions with related form and user (customize as per your models)
        $submissions = FormSubmission::with(['form', 'customer'])->latest()->paginate(20);

        return view('admin.form_submissions.index', compact('submissions'));
    }


    public function show(FormSubmission $submission)
    {
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


    // Publish the submission
    public function publish(FormSubmission $submission)
    {
        try {
            // Implement your publishing logic here
            // For example, set a 'published' flag and save:

            $submission->published = true;
            $submission->published_at = now();
            $submission->save();

            return response()->json(['success' => true, 'message' => 'Submission published successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to publish submission.'], 500);
        }
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

            $inputDataWithMeta[$fieldId] = [
                'field_id' => $fieldId,
                'label' => $fieldLabel,
                'value' => $value,
                'show_on_summary' => $showOnSummary,
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

        // dd($uploadedFiles);
        // Save submission with metadata-enriched non-file data
        $submission = \App\Models\FormSubmission::create([
            'form_id' => $formId,
            'customer_id' => $customerId,
            'data' => json_encode($inputDataWithMeta),
        ]);

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

        // Fetch submission with relations, including wallet via customer.wallet
        $submission = FormSubmission::with(['form.category', 'customer.wallet', 'files'])->findOrFail($id);

        // Fetch FormData for layout and fields
        $formData = \App\Models\FormData::where('form_id', $submission->form_id)->first();

        $layout = $formData && !empty($formData->field_layout) ? $formData->field_layout : [];
        $fields = $formData && !empty($formData->fields) ? $formData->fields : [];

        // Pass wallet balance separately if needed
        $walletBalance = optional($submission->customer->wallet)->balance ?? 0;

        return view('front.listing-details', compact('submission', 'layout', 'fields', 'walletBalance'));
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


}

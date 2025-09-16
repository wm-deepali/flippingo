<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FormSubmission;
use App\Models\FormSubmissionView;

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

        // If status is empty, clear published_at (or set as needed)
        if (!empty($status)) {

            // Optionally, set published_at if status means published
            if ($status === 'published') {
                $submission->published_at = now();
                sendNotification('listing_published', [
                    'customer_name' => $submission->customer->first_name . ' ' . $submission->customer->last_name,
                    'listing_title' => $submission->product_title,
                ], $submission->customer_id);

            }
        }

        $submission->save();

        // Add history record with optional remarks
        $submission->addHistory($status, $request->input('remarks'));

        return response()->json(['message' => 'Status updated successfully']);
    }


    public function enquiryIndex()
    {
        $enquiries = Enquiry::with('customer', 'submission.customer')->paginate(20);
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

    public function SubmissionList(Request $request)
    {
        $now = now();

        // Base query: all submissions with relations
        $baseQuery = FormSubmission::with(['form.category', 'customer']);

        // Helper to get submissions with aggregated stats
        $getWithStats = function ($from = null, $to = null) use ($baseQuery) {
            $statsQuery = \App\Models\FormSubmissionStat::selectRaw('form_submission_id')
                ->selectRaw('SUM(views) as views')
                ->selectRaw('SUM(clicks) as clicks')
                ->selectRaw('SUM(unique_views) as unique_views')
                ->groupBy('form_submission_id');

            // Apply date filters if provided
            if ($from && $to) {
                $statsQuery->whereBetween('date', [$from, $to]);
            } elseif ($from) {
                $statsQuery->whereDate('date', $from);
            }

            $stats = $statsQuery->get()->keyBy('form_submission_id');

            $submissions = (clone $baseQuery)->paginate(20);

            // Attach stats into each submission
            $submissions->getCollection()->transform(function ($submission) use ($stats) {
                $s = $stats[$submission->id] ?? null;
                $submission->period_views = $s->views ?? 0;
                $submission->period_clicks = $s->clicks ?? 0;
                $submission->period_unique = $s->unique_views ?? 0;
                return $submission;
            });

            return $submissions;
        };

        // Reports
        $reports['today'] = $getWithStats($now->toDateString());
        $reports['seven-day'] = $getWithStats($now->copy()->subDays(7)->toDateString(), $now->toDateString());
        $reports['fifteen-day'] = $getWithStats($now->copy()->subDays(15)->toDateString(), $now->toDateString());
        $reports['thirty-day'] = $getWithStats($now->copy()->subDays(30)->toDateString(), $now->toDateString());
        $reports['all-time'] = $getWithStats(); // <--- All time, no date filter

        return view('admin.reports.listing', compact('reports'));
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

        return view('admin.reports.analytics-detail', compact(
            'submission',
            'chartLabels',
            'chartViews',
            'chartClicks',
            'chartUniques'
        ));
    }
}

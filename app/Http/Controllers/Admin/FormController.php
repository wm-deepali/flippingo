<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Form;
use App\Http\Requests\UpdateFormSettingsRequest;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::all(); // fetch all saved forms
        return view('admin.form.index', compact('forms'));
    }


    public function show($id)
    {
        $form = Form::findOrFail($id);
        $formData = FormData::where('form_id', $form->id)->first();

        return view('admin.form.show', compact('form', 'formData'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $i18n = [
            'untitledForm' => __('Untitled Form'),
            'thisIsMyForm' => __('This is my form. Please fill it out. Thanks!'),
        ];

        $defaultForm = [
            'initForm' => [
                [
                    'name' => 'heading',
                    'fields' => [
                        'id' => [
                            'label' => 'component.id',
                            'type' => 'input',
                            'value' => 'heading_0'
                        ],
                        'text' => [
                            'label' => 'component.text',
                            'type' => 'input',
                            'value' => $i18n['untitledForm']
                        ],
                        'type' => [
                            'label' => 'component.type',
                            'type' => 'select',
                            'value' => [
                                ['value' => 'h1', 'label' => 'H1', 'selected' => true],
                                ['value' => 'h2', 'label' => 'H2', 'selected' => false],
                                ['value' => 'h3', 'label' => 'H3', 'selected' => false],
                                ['value' => 'h4', 'label' => 'H4', 'selected' => false],
                                ['value' => 'h5', 'label' => 'H5', 'selected' => false],
                                ['value' => 'h6', 'label' => 'H6', 'selected' => false],
                            ]
                        ],
                        'cssClass' => [
                            'label' => 'component.cssClass',
                            'type' => 'input',
                            'value' => '',
                            'advanced' => true
                        ],
                        'containerClass' => [
                            'label' => 'component.containerClass',
                            'type' => 'input',
                            'value' => 'col-md-12',
                            'advanced' => true
                        ]
                    ]
                ],
                [
                    'name' => 'paragraph',
                    'fields' => [
                        'id' => [
                            'label' => 'component.id',
                            'type' => 'input',
                            'value' => 'paragraph_0'
                        ],
                        'text' => [
                            'label' => 'component.text',
                            'type' => 'textarea',
                            'value' => $i18n['thisIsMyForm']
                        ],
                        'cssClass' => [
                            'label' => 'component.cssClass',
                            'type' => 'input',
                            'value' => '',
                            'advanced' => true
                        ],
                        'containerClass' => [
                            'label' => 'component.containerClass',
                            'type' => 'input',
                            'value' => 'col-md-12',
                            'advanced' => true
                        ]
                    ]
                ]
            ]
        ];

        return view('admin.form.create', compact('i18n', 'defaultForm'));
    }


    public function store(Request $request)
    {
        //  dd($request->all());
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|json',
            'builder' => 'required|json',
            'html' => 'nullable|string',
            'height' => 'nullable|numeric'
        ]);

        // Decode JSON fields
        $fields = json_decode($validated['fields'], true);
        $builder = json_decode($validated['builder'], true);

        // Create slug from name
        $slug = Str::slug($validated['name']);

        $userId = auth()->id(); // Get authenticated user ID

        // Save to `forms` table
        $form = Form::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'status' => true,
            'language' => 'en',
            'created_by' => $userId,
            'updated_by' => $userId,
        ]);

        // Save to `form_datas` table
        FormData::create([
            'form_id' => $form->id,
            'builder' => $builder,
            'fields' => $fields,
            'html' => $validated['html'] ?? '',
            'height' => $validated['height'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Form saved successfully',
            'form_id' => $form->id,
            'edit_url' => route('admin.form.edit', $form->id),
        ]);
    }

    public function edit($id)
    {
        $form = Form::findOrFail($id);
        $formData = FormData::where('form_id', $form->id)->first();

        return view('admin.form.edit', compact('form', 'formData'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|json',
            'builder' => 'required|json',
            'html' => 'nullable|string',
            'height' => 'nullable|numeric'
        ]);

        // Decode JSON fields
        $fields = json_decode($validated['fields'], true);
        $builder = json_decode($validated['builder'], true);

        // Find the existing form
        $form = Form::findOrFail($id);

        // Update form table
        $form->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => $form->status, // keep existing unless you add in form
            'language' => $form->language ?? 'en',
        ]);

        // Update form_datas table
        $formData = FormData::where('form_id', $form->id)->first();
        if ($formData) {
            $formData->update([
                'builder' => $builder,
                'fields' => $fields,
                'html' => $validated['html'] ?? '',
                'height' => $validated['height'] ?? null,
            ]);
        } else {
            // In case no FormData exists (fallback)
            FormData::create([
                'form_id' => $form->id,
                'builder' => $builder,
                'fields' => $fields,
                'html' => $validated['html'] ?? '',
                'height' => $validated['height'] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Form updated successfully',
            'form_id' => $form->id,
            'edit_url' => route('admin.form.edit', $form->id),
        ]);
    }

    public function settings($id)
    {
        $form = Form::findOrFail($id);
        $languages = ['en' => 'English', 'hi' => 'Hindi', 'ar' => 'Arabic']; // Example
        return view('admin.form.settings', compact('form', 'languages'));
    }


    public function updateSettings(UpdateFormSettingsRequest $request, $id)
    {
        $form = Form::findOrFail($id);

        $validatedData = $request->validated();

        // Nullify fields if toggles are off
        if (!$validatedData['authorized_urls']) {
            $validatedData['urls'] = null;
            $validatedData['authorized_urls_error_type'] = false;
            $validatedData['authorized_urls_error_message'] = null;
        }

        if (!$validatedData['use_password']) {
            $validatedData['password'] = null;
        }

        // Update form
        $form->fill($validatedData);
        $form->save();

        // Sync shared users if applicable
        if ($validatedData['shared_with'] === 'users' && !empty($validatedData['users'])) {
            $form->users()->sync($validatedData['users']);
        } else {
            $form->users()->detach();
        }

        // Return JSON response for AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => __('Settings updated successfully.')]);
        }

        // Redirect back for non-AJAX requests
        return redirect()->back()->with('success', __('Settings updated successfully.'));
    }



    public function conditionalRules($id)
    {
        // Show conditional rules management
    }

    public function copy($id)
    {
        // Duplicate form logic
    }

    public function publishShare($id)
    {
        // Show publish & share options
    }

    public function submissions($id)
    {
        // List form submissions
    }

    public function addons($id)
    {
        // Show addons integration
    }

    public function submissionsReport($id)
    {
        // Generate submissions report
    }


}

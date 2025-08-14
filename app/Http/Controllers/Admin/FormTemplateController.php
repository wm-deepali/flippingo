<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FormTemplate;
use App\Models\FormData;
use App\Models\Form;

class FormTemplateController extends Controller
{
    /**
     * List all templates
     */
    public function index()
    {
        $templates = FormTemplate::latest()->get();
        return view('admin.form_templates.index', compact('templates'));
    }


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
                                ['value' => 'h1', 'label' => 'H1', 'selected' => false],
                                ['value' => 'h2', 'label' => 'H2', 'selected' => false],
                                ['value' => 'h3', 'label' => 'H3', 'selected' => true],
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

        return view('admin.form.create', compact('i18n', 'defaultForm'))
            ->with('isTemplate', true); // we can use this flag in JS to save as template
    }


    public function createFormFromTemplate($template_id)
    {
        // Find the template
        $template = FormTemplate::findOrFail($template_id);

        // Create a new form based on the template's data
        $form = Form::create([
            'name' => $template->name . ' (Copy)',
            'slug' => Str::slug($template->name . '-' . time()),
            'status' => true,
            'language' => 'en',
        ]);

        // Store the form data based on template's stored builder and fields JSON
        FormData::create([
            'form_id' => $form->id,
            'fields' => $template->fields,  // already cast to array/json
            'builder' => $template->builder, // same as above
            'html' => $template->html ?? '',
            'height' => $template->height ?? null,
        ]);

        // Redirect to edit the newly created form
        return redirect()->route('admin.form.edit', $form->id)
            ->with('success', 'New form created from template. You can now edit it.');
    }

    /**
     * Store a new form template
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|json',
            'builder' => 'required|json',
            'html' => 'nullable|string',
            'height' => 'nullable|numeric',
        ]);

        $fields = json_decode($validated['fields'], true);
        $builder = json_decode($validated['builder'], true);

        $slug = Str::slug($validated['name']);

        $template = FormTemplate::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'fields' => $fields,
            'builder' => $builder,
            'html' => $validated['html'] ?? '',
            'height' => $validated['height'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Template saved successfully',
            'template_id' => $template->id,
        ]);
    }

    /**
     * Show one template for editing
     */
    public function edit($id)
    {
        $template = FormTemplate::findOrFail($id);
        return view('admin.form_templates.edit', compact('template'));
    }

    /**
     * Update a template
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|json',
            'builder' => 'required|json',
            'html' => 'nullable|string',
            'height' => 'nullable|numeric',
        ]);

        $template = FormTemplate::findOrFail($id);
        $template->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'fields' => json_decode($validated['fields'], true),
            'builder' => json_decode($validated['builder'], true),
            'html' => $validated['html'] ?? '',
            'height' => $validated['height'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Template updated successfully',
            'template_id' => $template->id,
        ]);
    }

    /**
     * Delete a template
     */
    public function destroy($id)
    {
        $template = FormTemplate::findOrFail($id);
        $template->delete();

        return redirect()->route('admin.formTemplates.index')
            ->with('success', 'Template deleted successfully.');
    }
}

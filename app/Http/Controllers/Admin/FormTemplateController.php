<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        // Fetch categories for select dropdown
        $categories = Category::all();

        // Localization strings
        $i18n = [
            'untitledForm' => __('Untitled Form'),
            'thisIsMyForm' => __('This is my form. Please fill it out. Thanks!'),
            'heading' => __('Heading Text Here'),
            'paragraphText' => __('Please enter your details below.'),
            'textField' => __('Text Field'),
            'numberField' => __('Number Field'),
            'productTitle' => __('Product Title'),
            'mrp' => __('MRP'),
            'discount' => __('Discount'),
            'offeredPrice' => __('Offered Price'),
        ];

        // Default fields to inject into form builder canvas
        $defaultForm = [
            'init' => true,   // optional flag if needed
            'initForm' => [
                [
                    'name' => 'heading',
                    'fields' => [
                        'id' => [
                            'label' => 'component.id',
                            'type' => 'input',
                            'value' => 'heading_0',
                        ],
                        'text' => [
                            'label' => 'component.text',
                            'type' => 'input',
                            'value' => $i18n['untitledForm'],
                        ],
                        'type' => [
                            'label' => 'component.type',
                            'type' => 'select',
                            'value' => [
                                ['value' => 'h1', 'label' => 'H1', 'selected' => true],
                                ['value' => 'h2', 'label' => 'H2', 'selected' => false],
                                ['value' => 'h3', 'label' => 'H3', 'selected' => false],
                            ],
                        ],
                        'cssClass' => [
                            'label' => 'component.cssClass',
                            'type' => 'input',
                            'value' => '',
                        ],
                        'containerClass' => [
                            'label' => 'component.containerClass',
                            'type' => 'input',
                            'value' => 'col-12',
                        ],
                    ],
                ],
                [
                    'name' => 'paragraph',
                    'fields' => [
                        'id' => [
                            'label' => 'component.id',
                            'type' => 'input',
                            'value' => 'paragraph_0',
                        ],
                        'text' => [
                            'label' => 'component.text',
                            'type' => 'textarea',
                            'value' => $i18n['thisIsMyForm'],
                        ],
                        'cssClass' => [
                            'label' => 'component.cssClass',
                            'type' => 'input',
                            'value' => '',
                        ],
                        'containerClass' => [
                            'label' => 'component.containerClass',
                            'type' => 'input',
                            'value' => 'col-12',
                        ],
                    ],
                ],
                // Product Title Field
                [
                    'name' => 'text',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'product_title'],
                        'inputType' => [
                            'label' => 'component.inputType',
                            'type' => 'select',
                            'value' => [['value' => 'text', 'label' => 'Text', 'selected' => true]],
                        ],
                        'label' => ['label' => 'component.label', 'type' => 'input', 'value' => $i18n['productTitle']],
                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => 'Enter product title'],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-control'],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                    'nonDeletable' => true
                ],
                // MRP Field
                [
                    'name' => 'number',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'mrp'],
                        'inputType' => [
                            'label' => 'component.inputType',
                            'type' => 'select',
                            'value' => [['value' => 'number', 'label' => 'Number', 'selected' => true]],
                        ],
                        'label' => ['label' => 'component.label', 'type' => 'input', 'value' => $i18n['mrp']],
                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => 'Enter MRP'],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-control'],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                    'nonDeletable' => true
                ],
                // Discount Field
                [
                    'name' => 'number',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'discount'],
                        'inputType' => [
                            'label' => 'component.inputType',
                            'type' => 'select',
                            'value' => [['value' => 'number', 'label' => 'Number', 'selected' => true]],
                        ],
                        'label' => ['label' => 'component.label', 'type' => 'input', 'value' => $i18n['discount']],
                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => 'Enter discount'],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-control'],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                    'nonDeletable' => true
                ],
                // Offered Price Field
                [
                    'name' => 'number',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'offered_price'],
                        'inputType' => [
                            'label' => 'component.inputType',
                            'type' => 'select',
                            'value' => [['value' => 'number', 'label' => 'Number', 'selected' => true]],
                        ],
                        'label' => ['label' => 'component.label', 'type' => 'input', 'value' => $i18n['offeredPrice']],
                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => 'Enter offered price'],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-control'],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                    'nonDeletable' => true
                ],
            ],
        ];

        return view('admin.form.create', compact('categories', 'defaultForm', 'i18n'))->with('isTemplate', true);
        ;
    }


    public function createFormFromTemplate($template_id)
    {
        // Find the template
        $template = FormTemplate::findOrFail($template_id);

        $first_category = Category::first();
        $userId = auth()->id();
        
        // Create a new form based on the template's data
        $form = Form::create([
            'name' => $template->name . ' (Copy)',
            'slug' => Str::slug($template->name . '-' . time()),
            'status' => true,
            'language' => 'en',
            'category_id' => $first_category->id,
            'created_by' => $userId,
            'updated_by' => $userId,
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $forms = Form::with('category')->get(); // fetch all saved forms
        return view('admin.form.index', compact('forms'));
    }


    public function show($id)
    {
        $form = Form::findOrFail($id);
        $formData = FormData::where('form_id', $form->id)->first();

        return view('admin.form.show', compact('form', 'formData'));
    }


   public function showFormHtml($id)
{
    $form = Form::findOrFail($id);
    $formData = FormData::where('form_id', $form->id)->first();

    // Get category via form relationship
    $category = $form->category; // make sure relationship exists

    $enableCountry = $category?->enable_country_filter ?? 0;

    // Build country dropdown HTML
    $countries = \DB::table('countries')->orderBy('name')->get();

    $countryHtml = view('partials.country-dropdown', [
        'countries' => $countries,
        'enableCountry' => $enableCountry
    ])->render();

    // Original form HTML
    $formHtml = $formData?->html ?? '';

    return response()->json([
        'success' => true,
        'html' => $countryHtml . $formHtml, // 👈 prepend country
        'fields' => $formData?->fields ?? [],
        'form_id' => $form->id,
        'form_name' => $form->name,
    ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get IDs of categories which already have a form
        $formCategoryIds = Form::distinct()->pluck('category_id')->toArray();

        // Fetch categories excluding those with forms
        $categories = Category::whereNotIn('id', $formCategoryIds)->get();

        // Localization strings
        $i18n = [
            'untitledForm' => __('Untitled Form'),
            'thisIsMyForm' => __('This is my form. Please fill it out. Thanks!'),
            'heading' => __('Heading Text Here'),
            'paragraphText' => __('Please enter your details below.'),
            'textField' => __('Text Field'),
            'numberField' => __('Number Field'),
            'productTitle' => __('Product Title'),
            'mrp' => __('Actual Cost'),
            'urgentSale' => __('Urgent Sale'),
            'offeredPrice' => __('Demand Price'),
            'yes' => __('Yes'),
            'no' => __('No'),
        ];

        $defaultForm = [
            'init' => true,
            'initForm' => [
                [
                    'name' => 'heading',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'heading_0'],
                        'text' => ['label' => 'component.text', 'type' => 'input', 'value' => $i18n['untitledForm']],
                        'type' => [
                            'label' => 'component.type',
                            'type' => 'select',
                            'value' => [
                                ['value' => 'h1', 'label' => 'H1', 'selected' => true],
                                ['value' => 'h2', 'label' => 'H2', 'selected' => false],
                                ['value' => 'h3', 'label' => 'H3', 'selected' => false],
                            ],
                        ],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => ''],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                ],

                // [
                //     "name" => "paragraph",
                //     "title" => "paragraph.title",
                //     "fields" => [
                //         "id" => [
                //             "label" => "component.id",
                //             "type" => "input",
                //             "value" => "paragraph",
                //         ],
                //         "text" => [
                //             "label" => "component.text",
                //             "type" => "textarea",
                //             "value" => $i18n['paragraphText'],
                //         ],
                //         "cssClass" => [
                //             "label" => "component.cssClass",
                //             "type" => "input",
                //             "value" => "",
                //             "advanced" => true,
                //         ],
                //         "containerClass" => [
                //             "label" => "component.containerClass",
                //             "type" => "input",
                //             "value" => "col-12",
                //             "advanced" => true,
                //         ],
                //     ],
                // ],
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
                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => 'Enter Actual Cost'],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-control'],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                    'nonDeletable' => true
                ],
                // Urgent Sale Select List
                [
                    'name' => 'selectlist',
                    'title' => 'selectlist.title',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'urgent_sale'],
                        'label' => ['label' => 'component.label', 'type' => 'input', 'value' => $i18n['urgentSale']],
                        'options' => [
                            'label' => 'component.options',
                            'type' => 'choice',
                            "value" => [
                                $i18n['yes'],
                                $i18n['no'] . "|selected",
                            ]
                        ],

                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => ''],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-select'],
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
                        'placeholder' => ['label' => 'component.placeholder', 'type' => 'input', 'value' => 'Enter Demand price'],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => 'form-control'],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
                    ],
                    'nonDeletable' => true
                ],
            ],
        ];

        return view('admin.form.create', compact('categories', 'defaultForm', 'i18n'))->with('isTemplate', false);
    }




    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => [
                'required',
                'exists:categories,id',
                function ($attribute, $value, $fail) {
                    if (Form::where('category_id', $value)->exists()) {
                        $fail('This category already has a form.');
                    }
                },
            ],
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
        $userId = auth()->id();

        // Save to `forms` table,
        $form = Form::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'status' => true,
            'language' => 'en',
            'created_by' => $userId,
            'updated_by' => $userId,
        ]);

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

        // Get ids of categories already linked to forms other than this form
        $formCategoryIds = Form::where('id', '!=', $form->id)
            ->distinct()
            ->pluck('category_id')
            ->toArray();

        // Fetch categories excluding those with forms already, but always include current form's category
        $categories = Category::whereNotIn('id', $formCategoryIds)
            ->orWhere('id', $form->category_id) // assuming form has category_id
            ->get();

        return view('admin.form.edit', compact('form', 'formData', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|json',
            'builder' => 'required|json',
            'html' => 'nullable|string',
            'category_id' => [
                'required',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($form) {
                    if (
                        Form::where('category_id', $value)
                            ->where('id', '!=', $form->id)
                            ->exists()
                    ) {
                        $fail('This category already has a form.');
                    }
                },
            ],
            'height' => 'nullable|numeric'
        ]);
        // Decode JSON fields
        $fields = json_decode($validated['fields'], true);
        $builder = json_decode($validated['builder'], true);
        // dd('here',$fields,$validated['fields']);

        // Find the existing form
        $form = Form::findOrFail($id);

        // Update form table
        $form->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => $form->status, // keep existing unless you add in form
            'language' => $form->language ?? 'en',
            'category_id' => $validated['category_id'],

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



    public function destroy($id)
    {
        $form = Form::find($id);
        if (!$form) {
            return response()->json(['success' => false, 'msgText' => 'Form not found']);
        }

        $form->delete();

        return response()->json(['success' => true]);
    }

    public function createFilter(Form $form)
    {
        $formData = FormData::where('form_id', $form->id)->first();
        $fields = [];

        if ($formData) {
            $decodedFields = is_array($formData->fields)
                ? $formData->fields
                : json_decode($formData->fields, true);

            if ($decodedFields) {
                foreach ($decodedFields as $field) {
                    // Skip headings/paragraphs since they aren’t input fields
                    if (in_array($field['type'], ['heading', 'paragraph', 'button'])) {
                        continue;
                    }

                    $properties = $field['properties'] ?? [];

                    $fields[] = [
                        'id' => $properties['id'] ?? $field['id'],
                        'label' => $properties['label'] ?? ucfirst($field['type']),
                        'type' => $field['type'] ?? 'text',
                    ];
                }
            }
        }

        // Fetch already saved filters
        $savedFilters = $form->filters()->get();

        return view('admin.form.filter-create', compact('form', 'fields', 'savedFilters'));
    }


    public function storeFilter(Request $request, Form $form)
    {
        $request->validate([
            'filters' => 'required|array',
        ]);

        // Fetch existing filters keyed by field_key
        $existingFilters = $form->filters()->get()->keyBy('field_key');

        // Map of available fields for label/type lookup
        $formData = FormData::where('form_id', $form->id)->first();
        $fieldMap = [];

        if ($formData) {
            $decodedFields = is_array($formData->fields)
                ? $formData->fields
                : json_decode($formData->fields, true);

            if ($decodedFields) {
                foreach ($decodedFields as $field) {
                    if (in_array($field['type'], ['heading', 'paragraph', 'button'])) {
                        continue;
                    }
                    $properties = $field['properties'] ?? [];
                    $key = $properties['id'] ?? $field['id'];
                    $fieldMap[$key] = [
                        'label' => $properties['label'] ?? ucfirst($field['type']),
                        'type' => $field['type'] ?? 'text',
                    ];
                }
            }
        }

        $submittedKeys = $request->filters;

        foreach ($submittedKeys as $index => $key) {
            if ($existingFilters->has($key)) {
                // Update position
                $existingFilters[$key]->update(['position' => $index]);
                // Remove from existingFilters to mark as handled
                $existingFilters->forget($key);
            } else {
                // New filter, create it
                $form->filters()->create([
                    'field_key' => $key,
                    'label' => $fieldMap[$key]['label'] ?? ucfirst(str_replace('_', ' ', $key)),
                    'type' => $fieldMap[$key]['type'] ?? 'text',
                    'position' => $index,
                ]);
            }
        }

        // Delete any remaining filters that were not in submittedKeys
        if ($existingFilters->isNotEmpty()) {
            $form->filters()->whereIn('field_key', $existingFilters->keys())->delete();
        }

        return response()->json(['success' => true]);
    }


    public function summaryCard(Form $form)
    {
        $formData = FormData::where('form_id', $form->id)->first();
        $fields = [];

        if ($formData) {
            $decodedFields = is_array($formData->fields)
                ? $formData->fields
                : json_decode($formData->fields, true);

            foreach ($decodedFields ?? [] as $field) {
                if (in_array($field['type'], ['heading', 'paragraph', 'button'])) {
                    continue;
                }

                $props = $field['properties'] ?? [];

                $fields[] = [
                    'id' => $props['id'] ?? $field['id'],
                    'label' => $props['label'] ?? ucfirst($field['type']),
                    'type' => $field['type']
                ];
            }
        }

        $savedCards = $form->summaryCards()->get();

        return view('admin.form.summary-card', compact(
            'form',
            'fields',
            'savedCards'
        ));
    }
    
    public function storeSummaryCard(Request $request, Form $form)
    {
        $request->validate([
            'cards' => 'required|array'
        ]);

        // Existing cards keyed by field_key
        $existing = $form->summaryCards()->get()->keyBy('field_key');

        foreach ($request->cards as $index => $card) {

            $fieldKey = $card['field_key'];

            $data = [
                'icon' => $card['icon'] ?? null,
                'color' => $card['color'] ?? '#000000',
                'position' => $index,
            ];

            if ($existing->has($fieldKey)) {

                // 🔁 Update existing card
                $existing[$fieldKey]->update($data);

                // Mark as handled
                $existing->forget($fieldKey);

            } else {

                // ➕ Create new card
                $form->summaryCards()->create([
                    'field_key' => $fieldKey,
                    'label' => $card['label'],
                    'icon' => $card['icon'] ?? null,
                    'color' => $card['color'] ?? '#000000',
                    'position' => $index,
                ]);
            }
        }

        // 🗑 Delete removed cards
        if ($existing->isNotEmpty()) {
            $form->summaryCards()
                ->whereIn('field_key', $existing->keys())
                ->delete();
        }

        return response()->json(['success' => true]);
    }


}

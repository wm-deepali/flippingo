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
        // Fetch the associated form data (fields/configuration) if any
        $formData = FormData::where('form_id', $form->id)->first();

        // Assuming you want to return the rendered form HTML or form data JSON
        // Here, returning HTML snippet or form JSON to inject into frontend

        // If form HTML is stored in form_data table under 'html'
        $html = $formData ? $formData->html : '';

        // Respond with HTML content to be injected
        return response()->json([
            'success' => true,
            'html' => $html,
            'form_id' => $form->id,
            'form_name' => $form->name,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
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
                [
                    'name' => 'paragraph',
                    'fields' => [
                        'id' => ['label' => 'component.id', 'type' => 'input', 'value' => 'paragraph_0'],
                        'text' => ['label' => 'component.text', 'type' => 'textarea', 'value' => $i18n['thisIsMyForm']],
                        'cssClass' => ['label' => 'component.cssClass', 'type' => 'input', 'value' => ''],
                        'containerClass' => ['label' => 'component.containerClass', 'type' => 'input', 'value' => 'col-12'],
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

        return view('admin.form.create', compact('categories', 'defaultForm', 'i18n'));
    }




    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Add this line
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
        // Fetch categories, for example: ID and Name
        $categories = Category::all(); // or use pluck('name', 'id') if you want an array
        // dd($formData->toArray());
        return view('admin.form.edit', compact('form', 'formData', 'categories'));
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
            'category_id' => 'required|exists:categories,id',
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


}

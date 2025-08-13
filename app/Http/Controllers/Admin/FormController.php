<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Form;

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
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.form.create');
    }


    public function store(Request $request)
    {
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

        // Save to `forms` table
        $form = Form::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'status' => true,
            'language' => 'en',
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


    //     public function store(Request $request)
// {
//     // Decode the FormBuilder payload
//     $data = $request->all();
//     $formBuilder = $data['FormBuilder'] ?? null;

    //     if (!$formBuilder || !isset($formBuilder['html'], $formBuilder['data'])) {
//         return response()->json(['status' => 'error', 'message' => 'Invalid form data'], 422);
//     }

    //     // ---- 1. Parse fields from HTML (basic example, you can improve)
//     $fields = $this->extractFieldsFromHtml($formBuilder['html']);

    //     // ---- 2. Save form main record
//     $form = Form::create([
//         'name' => $formBuilder['data']['settings']['name'] ?? 'Untitled Form',
//         'language' => app()->getLocale(),
//         'recaptcha' => $formBuilder['data']['settings']['recaptcha'] ?? 0,
//     ]);

    //     // ---- 3. Save form data record
//     FormData::create([
//         'form_id' => $form->id,
//         'builder' => json_encode($formBuilder['data']),
//         'fields' => json_encode($fields),
//         'html' => htmlentities($formBuilder['html']),
//         'height' => (int) ($formBuilder['data']['height'] ?? 500),
//     ]);

    //     // ---- 4. Related tables
//     FormUI::create([
//         'form_id' => $form->id,
//         'theme' => $formBuilder['data']['ui']['theme'] ?? 'default'
//     ]);

    //     FormConfirmation::create([
//         'form_id' => $form->id,
//         'message' => $formBuilder['data']['confirmation']['message'] ?? 'Thank you for your submission.'
//     ]);

    //     FormEmail::create([
//         'form_id' => $form->id,
//         'to' => $formBuilder['data']['email']['to'] ?? '',
//         'subject' => $formBuilder['data']['email']['subject'] ?? 'New form submission'
//     ]);

    //     return response()->json(['status' => 'success', 'form_id' => $form->id]);
// }

}

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

}

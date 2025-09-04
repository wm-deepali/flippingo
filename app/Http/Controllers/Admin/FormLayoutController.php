<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormData;
use Illuminate\Http\Request;

class FormLayoutController extends Controller
{
    public function edit($id)
    {
        $form = Form::with('formData')->findOrFail($id);
        $FormData = FormData::where('form_id', $form->id)->first();
        $fields = [];

        if ($FormData && !empty($FormData->fields)) {
            $fields = is_array($FormData->fields) ? $FormData->fields : [];
        }

        $layout = $FormData && !empty($FormData->field_layout)
            ? $FormData->field_layout
            : null;

        // dd($layout);
        return view('admin.form-layout.edit', compact('form', 'fields', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        $formData = $form->formData;
        
        $validated = $request->validate([
            'field_layout' => 'required|array',
        ]);
        
        if ($formData) {
            $formData->update([
                'field_layout' => $validated['field_layout'],
            ]);
        } else {
            // Create formData if missing
            FormData::create([
                'form_id' => $form->id,
                'fields' => json_encode([]), // or legacy data
                'builder' => json_encode([]),
                'field_layout' => $validated['field_layout'],
            ]);
        }
        
        // dd($form->toArray());
              return response()->json([
            'success' => true,
            'message' => 'Form layout updated successfully.',
            'form_id' => $form->id,
            'edit_url' => route('admin.form-layout.edit', $form->id),
        ]);
    }

}

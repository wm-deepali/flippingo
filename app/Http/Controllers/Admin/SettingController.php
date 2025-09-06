<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        // Pass all settings to the view
        $settings = Setting::pluck('value', 'key')->toArray();
        // dd($settings);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except(['_token']) as $key => $value) {
            // Handle file uploads
            if ($request->hasFile($key)) {
                $file = $request->file($key);

                // Store in /storage/app/public/settings/
                $path = $file->store('settings', 'public');

                // Save only the relative path
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
            } else {
                // Handle normal values
                if (is_array($value)) {
                    $value = json_encode($value); // store arrays as JSON
                }

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Settings updated successfully!']);
        }

        return back()->with('success', 'Settings updated successfully!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.add-category')->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input including slug and icon_image consistently
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:155',
            'slug' => 'required|max:155',
            'status' => 'required',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5024',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                // Handle file upload if present
                $imagePath = null;
                if ($request->hasFile('icon_image')) {
                    $imagePath = $request->file('icon_image')->store('categories', 'public');
                }

                Category::create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'is_popular' => $request->has('is_popular') ? 1 : 0,
                    'image' => $imagePath,
                ]);


                DB::commit();
                return response()->json(['success' => true]);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.edit-category')->with([
                    'category' => $category,
                ])->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate including slug and image (use icon_image or image consistently)
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:155',
            'slug' => 'required|max:155',
            'status' => 'required',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5024',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $category = Category::findOrFail($id);

                // Handle new uploaded image and delete old one if exists
                if ($request->hasFile('icon_image')) {
                    if ($category->image && Storage::disk('public')->exists($category->image)) {
                        Storage::disk('public')->delete($category->image);
                    }
                    $category->image = $request->file('icon_image')->store('categories', 'public');
                }

                // Update category properties including slug and image path
                $category->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'is_popular' => $request->has('is_popular') ? 1 : 0,
                    'image' => $category->image,
                ]);


                DB::commit();
                return response()->json(['success' => true]);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);

            // Delete the category image if exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            // Delete the category record
            $category->delete();

            DB::commit();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}

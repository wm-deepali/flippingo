<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.blog-categories.index')->with([
            'categories' => $categories
        ]);
    }


    public function create()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('admin.blog-categories.create')->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }


    public function store(Request $request)
    {
        // Validate input including slug and icon_image consistently
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:155',
            'slug' => 'required|max:155',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {

                BlogCategory::create([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'status' => $request->status,
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

    public function edit($id)
    {
        try {
            $category = BlogCategory::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.blog-categories.edit')->with([
                    'category' => $category
                ])->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        // Validate including slug and image (use icon_image or image consistently)
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:155',
            'slug' => 'required|max:155',
            'status' => 'required',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $category = BlogCategory::findOrFail($id);

                // Update category properties including slug and image path
                $category->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'status' => $request->status,
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


    public function destroy($id)
    {
        try {
            $category = BlogCategory::findOrFail($id);
            $category->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}

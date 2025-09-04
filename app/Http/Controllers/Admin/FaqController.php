<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        $categories = FaqCategory::all(); // Fetch all FAQ categories
        $faqTypes = ['Buyers FAQ', 'Seller FAQ']; // Example types

        return view('admin.content.faq', compact('faqs', 'categories', 'faqTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'type' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        Faq::create($validated);

        return response()->json(['success' => true, 'message' => 'FAQ added successfully!']);
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'type' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($validated);

        return response()->json(['success' => true, 'message' => 'FAQ updated successfully.']);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
    }

    public function publicIndex()
    {
        $faqs = Faq::where('status', 'published')->get();
        return view('front.faq', compact('faqs'));
    }
}

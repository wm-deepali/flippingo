<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        $submission = FormSubmission::with(['customer', 'form.category'])
            ->find($request->query('submission_id'));

        $submittedValues = $submission ? json_decode($submission->data, true) : [];
        $mrp = $submittedValues['mrp']['value'] ?? 0;
        $offeredPrice = $submittedValues['offered_price']['value'] ?? 0;
        $productTitle = $submittedValues['product_title']['value'] ?? '';
        $discount = $submittedValues['discount']['value'] ?? 0;
        $walletBalance = optional($submission->customer->wallet)->balance ?? 0;

        // Category from form relation
        $category = optional($submission->form->category)->name ?? '';

        // ✅ Product photo from related files
        $productPhoto = optional(
            $submission->files()
                ->where('field_name', 'photo')
                ->where('show_on_summary', true)
                ->first()
        )->file_path;

        // Buyer/Admin states
        $BuyerState = optional(Auth::guard('customer')->user())->state ?? null;
        $adminState = Setting::where('key', 'billing_state')->value('value') ?? null;
        // dd($BuyerState);
        // GST rates from settings
        $igstRate = Setting::where('key', 'igst')->value('value') ?? 18;
        $cgstRate = Setting::where('key', 'cgst')->value('value') ?? 9;
        $sgstRate = Setting::where('key', 'sgst')->value('value') ?? 9;

        // GST calculation
        $gstType = 'igst';
        $igst = $cgst = $sgst = 0;

        if ($BuyerState && $adminState && $BuyerState == $adminState) {
            // Within same state → CGST + SGST
            $gstType = 'cgst_sgst';
            $cgst = ($offeredPrice * $cgstRate) / 100;
            $sgst = ($offeredPrice * $sgstRate) / 100;
        } else {
            // Different states → IGST
            $igst = ($offeredPrice * $igstRate) / 100;
        }

        // Final total
        $total = $offeredPrice + $igst + $cgst + $sgst;

        return view('front.checkout', compact(
            'submission',
            'submittedValues',
            'productTitle',
            'offeredPrice',
            'mrp',
            'discount',
            'walletBalance',
            'category',
            'productPhoto',
            'gstType',
            'igst',
            'cgst',
            'sgst',
            'total'
        ));
    }


}

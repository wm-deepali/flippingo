<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrder;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductOrderController extends Controller
{
    public function index()
    {
        $orders = ProductOrder::with(['customer', 'seller'])->latest()->paginate(20);
        return view('admin.product-orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = ProductOrder::with([
            'customer',
            'seller',
            'payment',
            'statuses',
            'submission.form.category',
            'submission.files'
        ])->findOrFail($id);

        // Decode submission data
        $submittedValues = $order->submission ? json_decode($order->submission->data, true) : [];

        $productTitle = $submittedValues['product_title']['value'] ?? '-';
        $mrp = $submittedValues['mrp']['value'] ?? 0;
        $offeredPrice = $submittedValues['offered_price']['value'] ?? 0;
        $discount = $submittedValues['discount']['value'] ?? 0;

        // Category
        $category = optional($order->submission->form->category)->name ?? '-';

        // Product photo (first file with show_on_summary = true)
        $productPhoto = optional(
            $order->submission->files()->where('show_on_summary', true)->first()
        )->file_path ?? null;

        return view('admin.product-orders.show', compact(
            'order',
            'submittedValues',
            'productTitle',
            'mrp',
            'offeredPrice',
            'discount',
            'category',
            'productPhoto'
        ));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'remarks' => 'required|string|max:1000',
        ]);

        $order = ProductOrder::findOrFail($id);

        $data = [
            'status' => $request->status,
            'remarks' => $request->remarks,
        ];

        // If delivered, allow additional fields
        if ($request->status == 'delivered') {
            $data['delivery_date'] = $request->delivery_date ?? now();
            $data['delivery_method'] = $request->delivery_method ?? 'N/A';
        }

        // If cancelled, allow additional fields
        if ($request->status == 'cancelled') {
            $data['cancelled_by'] = auth()->id(); // current admin
            $data['cancellation_reason'] = $request->cancellation_reason ?? 'N/A';
            $data['cancelled_at'] = now();
        }

        $order->statuses()->create($data);

        return response()->json(['success' => true, 'message' => 'Order status updated successfully.']);
    }

    public function destroy($id)
    {
        $order = ProductOrder::findOrFail($id);

        // Optional: Delete related statuses if needed
        $order->statuses()->delete();

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully.'
        ]);
    }



    public function downloadInvoice($id)
    {
        $order = ProductOrder::with([
            'customer',
            'seller',
            'payment',
            'statuses',
            'submission.form.category',
            'submission.files'
        ])->findOrFail($id);

        $submittedValues = $order->submission ? json_decode($order->submission->data, true) : [];

        $productTitle = $submittedValues['product_title']['value'] ?? '-';
        $mrp = $submittedValues['mrp']['value'] ?? 0;
        $offeredPrice = $submittedValues['offered_price']['value'] ?? 0;
        $discount = $submittedValues['discount']['value'] ?? 0;
        $category = optional($order->submission->form->category)->name ?? '-';
        $productPhoto = optional($order->submission->files()->where('show_on_summary', true)->first())->file_path ?? null;

        $pdf = Pdf::loadView('admin.product-orders.invoice', compact(
            'order',
            'productTitle',
            'mrp',
            'offeredPrice',
            'discount',
            'category',
            'productPhoto'
        ));

        return $pdf->download('Invoice_' . $order->order_number . '.pdf');
    }

    public function viewInvoice($id)
    {
        $order = ProductOrder::with([
            'customer',
            'seller',
            'payment',
            'statuses',
            'submission.form.category',
            'submission.files'
        ])->findOrFail($id);

        // Decode submission data
        $submittedValues = $order->submission ? json_decode($order->submission->data, true) : [];

        $type = 'product';
        $order->product = [
            "productTitle" => $submittedValues['product_title']['value'] ?? '-',
            "offeredPrice" => $submittedValues['offered_price']['value'] ?? 0,
            "category" => optional($order->submission->form->category)->name ?? '-',
            "productPhoto" => optional($order->submission->files()->where('show_on_summary', true)->first())->file_path ?? null,
        ];

        // Return the Blade view for showing invoice
        return view('admin.payments.invoice', compact(
            'order',
            'type'
        ));
    }


}

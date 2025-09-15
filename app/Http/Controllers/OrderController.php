<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function buyerOrders()
    {
        $user = Auth::guard('customer')->user();

        $query = ProductOrder::with(['seller', 'currentStatus'])
            ->where('customer_id', $user->id)
            ->latest();

        $orders = $query->get();

        // Categorize by status
        $recentOrders = $orders->filter(fn($o) => in_array($o->currentStatus->status ?? '', ['recent', 'approved', 'processing',]));
        $deliveredOrders = $orders->filter(fn($o) => in_array($o->currentStatus->status ?? '', ['delivered']));
        $cancelRequestedOrders = $orders->filter(fn($o) => $o->currentStatus->status === 'cancel_requested');
        $refundOrders = $orders->filter(fn($o) => $o->currentStatus->status === 'cancelled');

        // Counts
        $counts = [
            'recent' => $recentOrders->count(),
            'delivered' => $deliveredOrders->count(),
            'cancel_requested' => $cancelRequestedOrders->count(),
            'refunds' => $refundOrders->count(),
        ];

        return view('user.orders.buyer', compact('recentOrders', 'deliveredOrders', 'cancelRequestedOrders', 'refundOrders', 'counts'));
    }

    public function sellerOrders()
    {
        $user = Auth::guard('customer')->user();

        $query = ProductOrder::with(['customer', 'currentStatus'])
            ->where('seller_id', $user->id)
            ->latest();

        $orders = $query->get();

        // Categorize by status
        $recentOrders = $orders->filter(fn($o) => in_array($o->currentStatus->status ?? '', ['recent', 'approved', 'processing']));
        $deliveredOrders = $orders->filter(fn($o) => in_array($o->currentStatus->status ?? '', ['delivered']));
        $cancelRequestedOrders = $orders->filter(fn($o) => $o->currentStatus->status === 'cancel_requested');
        $refundOrders = $orders->filter(fn($o) => $o->currentStatus->status === 'cancelled');

        // Counts
        $counts = [
            'recent' => $recentOrders->count(),
            'delivered' => $deliveredOrders->count(),
            'cancel_requested' => $cancelRequestedOrders->count(),
            'refunds' => $refundOrders->count(),
        ];

        return view('user.orders.seller', compact('recentOrders', 'deliveredOrders', 'cancelRequestedOrders', 'refundOrders', 'counts'));
    }

    public function cancelOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:product_orders,id',
            'reason' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        $order = ProductOrder::findOrFail($request->order_id);

        // Only allow request if order is still in cancellable statuses
        if (!in_array($order->currentStatus->status, ['recent', 'approved', 'processing'])) {
            return response()->json(['message' => 'Order cannot be cancelled now.'], 400);
        }

        // Save "cancellation request" instead of cancelling directly
        $order->statuses()->create([
            'status' => 'cancel_requested',
            'remarks' => $request->remarks,
            'requested_by' => Auth::guard('customer')->user()->id,
            'cancellation_reason' => $request->reason ?? 'N/A',
            'requested_at' => now()
        ]);

        return response()->json([
            'message' => 'Your cancellation request has been submitted. Admin will review it.'
        ]);
    }

    // Order detail page
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

        $order->product = [
            "productTitle" => $submittedValues['product_title']['value'] ?? '-',
            "offeredPrice" => $submittedValues['offered_price']['value'] ?? 0,
            "category" => optional($order->submission->form->category)->name ?? '-',
            "productPhoto" => optional($order->submission->files()->where('show_on_summary', true)->first())->file_path ?? null,
        ];


        return view('user.orders.details', compact(
            'order',
        ));
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

        $order->product = [
            "productTitle" => $submittedValues['product_title']['value'] ?? '-',
            "offeredPrice" => $submittedValues['offered_price']['value'] ?? 0,
            "category" => optional($order->submission->form->category)->name ?? '-',
            "productPhoto" => optional($order->submission->files()->where('show_on_summary', true)->first())->file_path ?? null,
        ];

        $type = 'product';
        // Return the Blade view for showing invoice
        return view('user.orders.invoice', compact(
            'order',
            'type'
        ));
    }
}

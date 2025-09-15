<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentRefund;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\ProductOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;


class ProductOrderController extends Controller
{
    public function index()
    {
        $orders = ProductOrder::with(['customer', 'seller'])->latest()->paginate(20);
        return view('admin.product-orders.index', compact('orders'));
    }

    public function sellerOrders($sellerId)
    {
        // Fetch orders of this seller only
        $orders = ProductOrder::with(['customer', 'seller'])
            ->where('seller_id', $sellerId)
            ->latest()
            ->paginate(20);

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

    public function reports(Request $request)
    {
        $reports = [
            'recent' => ProductOrder::with('customer', 'seller')->orderByDesc('created_at')->get(),

            'seven-day' => ProductOrder::with('customer', 'seller')
                ->whereBetween('created_at', [now()->subDays(7)->startOfDay(), now()->endOfDay()])
                ->get(),

            'fifteen-day' => ProductOrder::with('customer', 'seller')
                ->whereBetween('created_at', [now()->subDays(15)->startOfDay(), now()->endOfDay()])
                ->get(),

            'thirty-day' => ProductOrder::with('customer', 'seller')
                ->whereBetween('created_at', [now()->subDays(30)->startOfDay(), now()->endOfDay()])
                ->get(),

            'custom-date' => collect(), // handle custom date filter separately
        ];

        // dd($reports);

        return view('admin.reports.sales', compact('reports'));
    }

    public function customDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $reports = ProductOrder::whereBetween('created_at', [
            $request->start_date,
            $request->end_date
        ])->get();

        if ($reports->count() > 0) {
            return view('admin.reports.sale-table', [
                'orders' => $reports
            ]);
        } else {
            return '<p class="text-center text-muted mt-4">No Subscription records found for this range.</p>';
        }
    }



    public function cancellationRequests()
    {
        $orders = ProductOrder::with(['customer', 'seller', 'statuses'])
            ->whereHas('statuses', function (Builder $query) {
                // Filter where the latest status (max created_at) is cancel_requested
                $query->where('status', 'cancel_requested')
                    ->whereIn('id', function ($subquery) {
                    $subquery->selectRaw('MAX(id)')
                        ->from('order_statuses')
                        ->groupBy('product_order_id');
                });
            })
            ->orderByDesc('id')
            ->get();

        return view('admin.product-orders.cancellation-requests', compact('orders'));
    }


    public function approveCancellation(Request $request, $orderId)
    {
        $order = ProductOrder::findOrFail($orderId);

        $request->validate([
            'refund_method' => 'required|in:source_account,wallet',
            'payment_date' => 'required_if:refund_method,source_account|nullable|date',
            'reference_id' => 'required_if:refund_method,source_account|nullable|string',
            'remarks' => 'nullable|string',
            'screenshot' => 'nullable|image|max:2048',
        ]);

        $refundData = [
            'product_order_id' => $order->id,
            'refund_method' => $request->refund_method,
            'amount' => $order->total,
            'remarks' => $request->remarks,
        ];

        if ($request->refund_method == 'source_account') {
            $refundData['payment_date'] = $request->payment_date;
            $refundData['reference_id'] = $request->reference_id;
            if ($request->hasFile('screenshot')) {
                $refundData['screenshot'] = $request->file('screenshot')->store('refunds', 'public');
            }
        }

        // Save refund record
        $refund = PaymentRefund::create($refundData);

        if ($request->refund_method == 'wallet') {
            // Credit buyer wallet
            $buyerWallet = Wallet::firstOrCreate(['customer_id' => $order->customer->id]);
            $remarks = 'Refund for order cancellation #' . $order->order_number;
            $buyerWallet->addTransaction('credit', $order->total, 'Refund', $remarks);
        }

        // Debit seller wallet for refund amount
        $sellerWallet = Wallet::firstOrCreate(['customer_id' => $order->seller->id]);
        if ($sellerWallet->balance >= $order->seller_earning) {
            $debitRemarks = 'Debit for refund against cancelled order #' . $order->order_number;
            $sellerWallet->addTransaction('debit', $order->seller_earning, 'Refund Debit', $debitRemarks);
            $sellerWallet->balance -= $order->seller_earning;
            $sellerWallet->save();
        } else {
            // Handle insufficient seller balance if needed, e.g. throw error or log
        }

        // Find the latest cancel_requested status for the order
        $cancelRequestedStatus = $order->statuses()
            ->where('status', 'cancel_requested')
            ->latest('created_at')
            ->first();

        $cancellationReason = $cancelRequestedStatus ? $cancelRequestedStatus->cancellation_reason : 'N/A';

        // Update order status record with cancellation_reason
        $order->statuses()->create([
            'status' => 'cancelled',
            'remarks' => 'Cancellation approved and refund processed',
            'cancellation_reason' => $cancellationReason,
            'cancelled_by' => auth()->id(),
            'cancelled_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }



    public function rejectCancellation($id)
    {
        $order = ProductOrder::findOrFail($id);

        // Retrieve statuses ordered by creation, latest last
        $statuses = $order->statuses()->orderBy('created_at', 'asc')->get();

        // Find the index of the latest 'cancel_requested' status
        $cancelIndex = $statuses->where('status', 'cancel_requested')->keys()->last();

        // Ensure there's a cancel_requested status and a previous status exists
        if ($cancelIndex !== null && $cancelIndex > 0) {
            // Get the status immediately before cancel_requested
            $previousStatus = $statuses[$cancelIndex - 1];

            // Record previous status as new status entry
            $order->statuses()->create([
                'status' => $previousStatus->status,
                'remarks' => 'Cancellation request rejected; reverted to previous status',
            ]);

            return redirect()->back()->with('success', 'Order cancellation request rejected and previous status restored.');
        }

        return redirect()->back()->with('error', 'Invalid request or no status to revert to.');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentRefund;
use App\Models\ProductOrder;
use App\Models\Subscription;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscriptionController extends Controller
{

    public function index()
    {

        $now = Carbon::now();

        // Update subscriptions where end_date is past and status is not 'expired'
        Subscription::where('end_date', '<', $now)
            ->where('status', '!=', 'expired')
            ->update(['status' => 'expired']);

        $subscriptions = Subscription::with(['customer', 'package', 'payment', 'refund'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.subscriptions.orders', compact('subscriptions'));
    }
    public function show($id)
    {
        $subscription = Subscription::with(['package', 'customer', 'payment', 'refund'])->findOrFail($id);

        // Pass to an order detail view specific for subscriptions
        return view('admin.subscriptions.show', compact('subscription'));
    }



    public function cancellationRequests()
    {
        // Get all subscriptions that have a cancel request
        $subscriptions = Subscription::with('customer', 'package')
            ->where('status', 'cancel_requested')
            ->orderBy('cancel_requested_at', 'desc')
            ->get();

        return view('admin.subscriptions.cancellation-requests', compact('subscriptions'));
    }

    public function approveCancellation(Request $request, $subscriptionId)
    {
        $subscription = Subscription::findOrFail($subscriptionId);
        $request->validate([
            'refund_method' => 'required|in:source_account,wallet',
            'payment_date' => 'required_if:refund_method,source_account|nullable|date',
            'reference_id' => 'required_if:refund_method,source_account|nullable|string',
            'remarks' => 'nullable|string',
            'screenshot' => 'nullable|image|max:2048',
        ]);

        $refundData = [
            'subscription_id' => $subscription->id,
            'refund_method' => $request->refund_method,
            'amount' => $subscription->package->offered_price,
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
            // Credit user wallet
            $user = $subscription->customer;
            $wallet = Wallet::firstOrCreate(['customer_id' => $user->id]);

            $remarks = 'Refund for subscription cancellation #' . $subscription->id;
            // Credit wallet for refund
            $wallet->addTransaction('credit', $subscription->package->offered_price, 'Refund', $remarks);

            sendNotification('wallet_credit', [
                'amount' => $subscription->package->offered_price,
                'balance' => $wallet->balance,
            ], $wallet->customer_id);
        }

        // Update subscription status
        $subscription->status = 'cancelled';
        $subscription->save();

        return response()->json(['success' => true]);

    }

    public function rejectCancellation(Subscription $subscription)
    {
        // Only allow if current status is cancel_requested
        if ($subscription->status === 'cancel_requested') {
            $subscription->status = 'active'; // revert back to active
            $subscription->cancel_reason = null;
            $subscription->cancel_requested_at = null;
            $subscription->save();

            return redirect()->back()->with('success', 'Subscription cancellation rejected successfully.');
        }

        return redirect()->back()->with('error', 'Invalid subscription status.');
    }



    public function payments()
    {
        // Fetch payment data with relationships if needed (e.g., subscription, customer)
        $payments = Payment::with(['subscription.customer', 'subscription.invoice', 'product.customer', 'product.seller', 'product.invoice'])->orderByDesc('created_at')->get();
        // dd($payments->toArray());
        return view('admin.payments.index', compact('payments'));
    }


    // Example Controller method
    public function viewInvoice($type, $orderId)
    {
        if ($type == 'subscription') {
            $order = Subscription::with(['package', 'customer', 'payment', 'invoice'])->findOrFail($orderId);
        } else {
            $order = ProductOrder::with([
                'customer',
                'seller',
                'payment',
                'statuses',
                'submission.form.category',
                'submission.files'
            ])->findOrFail($orderId);

            // Decode submission data
            $submittedValues = $order->submission ? json_decode($order->submission->data, true) : [];


            $order->product = [
                "productTitle" => $submittedValues['product_title']['value'] ?? '-',
            "offeredPrice" => $order->amount, // ✅ FIX
            "category" => optional($order->submission->form->category)->name ?? '-',
            "productPhoto" => optional(
                $order->submission->files()->where('show_on_summary', true)->first()
            )->file_path ?? null,
            ];
        }
        return view('admin.payments.invoice', compact('order', 'type'));
    }

    public function reports(Request $request)
    {
        $allSubs = Subscription::with('package', 'customer')->get();

        $reports = [
            'active' => $allSubs->where('status', 'active'),
            'expiring-today' => $allSubs->filter(fn($sub) => Carbon::parse($sub->end_date)->isToday()),
            'seven-day' => $allSubs->filter(fn($sub) => Carbon::parse($sub->end_date)->between(Carbon::today(), Carbon::today()->addDays(7))),
            'fifteen-day' => $allSubs->filter(fn($sub) => Carbon::parse($sub->end_date)->between(Carbon::today(), Carbon::today()->addDays(15))),
            'thirty-day' => $allSubs->filter(fn($sub) => Carbon::parse($sub->end_date)->between(Carbon::today(), Carbon::today()->addDays(30))),
            'custom-date' => collect(), // handle custom date filter
        ];
        return view('admin.reports.subscriptions', compact('reports'));
    }

    public function customDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $subscriptions = Subscription::whereBetween('end_date', [
            $request->start_date,
            $request->end_date
        ])->get();

        if ($subscriptions->count() > 0) {
            return view('admin.reports.sub-table', [
                'subscriptions' => $subscriptions
            ]);
        } else {
            return '<p class="text-center text-muted mt-4">No Subscription records found for this range.</p>';
        }
    }

}


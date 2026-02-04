<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FormSubmission;
use App\Models\OrderStatus;
use App\Models\ProductOrder;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\CurrencyHelper;
use App\Helpers\IpHelper;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $submission = FormSubmission::with([
            'customer.wallet',
            'form.category',
            'files'
        ])->findOrFail($request->query('submission_id'));

        /* ==============================
         | 🌍 VIEWER CURRENCY (UI ONLY)
         ============================== */
        $viewerCurrency = IpHelper::countryCode() === 'in' ? 'INR' : 'USD';
        $currencySymbol = $viewerCurrency === 'INR' ? '₹' : '$';

        $usdRate = CurrencyHelper::usdRate();

        /* ==============================
         | 📄 FORM DATA
         ============================== */
        $data = json_decode($submission->data, true) ?? [];

        $productTitle = $data['product_title']['value'] ?? '';
        $mrp = (float) ($data['mrp']['value'] ?? 0);

        $basePrice = ($data['urgent_sale']['value'] ?? '') === 'Yes'
            ? (float) ($data['offered_price']['value'] ?? 0)
            : $mrp;

        /* ==============================
         | 📷 PRODUCT INFO
         ============================== */
        $category = optional($submission->form->category)->name ?? '';
        $productPhoto = optional(
            $submission->files()->where('show_on_summary', true)->first()
        )->file_path;

        /* ==============================
         | 🔑 NORMALIZE TO INR (SOURCE)
         ============================== */
        $submissionCurrency = $submission->currency ?? 'INR';

        $basePriceINR = CurrencyHelper::convert($basePrice, $submissionCurrency, 'INR', $usdRate);
        $mrpINR = CurrencyHelper::convert($mrp, $submissionCurrency, 'INR', $usdRate);

        /* ==============================
         | 🧮 GST (INR SOURCE)
         ============================== */
        $igst = $cgst = $sgst = 0;
        $gstType = 'none';

        $buyerState = optional(auth('customer')->user())->state;
        $adminState = Setting::where('key', 'billing_state')->value('value');

        if ($buyerState && $adminState && $buyerState == $adminState) {
            $gstType = 'cgst_sgst';
            $cgst = round($basePriceINR * setting('cgst', 9) / 100, 2);
            $sgst = round($basePriceINR * setting('sgst', 9) / 100, 2);
        } else {
            $gstType = 'igst';
            $igst = round($basePriceINR * setting('igst', 18) / 100, 2);
        }


        $totalINR = round($basePriceINR + $igst + $cgst + $sgst, 2);

        /* ==============================
         | 💱 UI CONVERSION (DISPLAY)
         ============================== */
        $displayPrice = CurrencyHelper::convert($basePriceINR, 'INR', $viewerCurrency, $usdRate);
        $total = CurrencyHelper::convert($totalINR, 'INR', $viewerCurrency, $usdRate);

        $igstDisplay = CurrencyHelper::convert($igst, 'INR', $viewerCurrency, $usdRate);
        $cgstDisplay = CurrencyHelper::convert($cgst, 'INR', $viewerCurrency, $usdRate);
        $sgstDisplay = CurrencyHelper::convert($sgst, 'INR', $viewerCurrency, $usdRate);

        /* ==============================
         | 💳 WALLET
         ============================== */
        $walletRaw = optional($submission->customer->wallet)->balance ?? 0;
        $walletBalance = CurrencyHelper::convert($walletRaw, 'INR', $viewerCurrency, $usdRate);
        $requiredAmount = max(0, $total - $walletBalance);

        $requiredAmountINR = max(0, $totalINR - $walletRaw);

        return view('front.checkout', compact(
            'submission',
            'productTitle',
            'category',
            'productPhoto',

            'displayPrice',
            'total',

            'gstType',
            'igstDisplay',
            'cgstDisplay',
            'sgstDisplay',

            'viewerCurrency',
            'currencySymbol',

            'walletBalance',
            'requiredAmount',

            'totalINR',     // 🔒 Razorpay source
            'walletRaw',    // 🔒 Wallet source
            'usdRate',
            'requiredAmountINR'
        ));
    }


    public function placeOrder(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'payment_method' => 'required|in:pay_online,wallet',
            'razorpay_payment_id' => 'nullable|string',
            'submission_id' => 'required|integer|exists:form_submissions,id',
        ]);

        $user = Auth::guard('customer')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required'], 401);
        }

        $submission = FormSubmission::with('customer.wallet')->findOrFail($request->submission_id);
        $submittedValues = json_decode($submission->data, true) ?? [];

        $basePrice = ($submittedValues['urgent_sale']['value'] ?? '') === 'Yes'
            ? (float) ($submittedValues['offered_price']['value'] ?? 0)
            : (float) ($submittedValues['mrp']['value'] ?? 0);

        /*
        |--------------------------------------------------------------------------
        | 🔑 NORMALIZE TO INR (CRITICAL FIX)
        |--------------------------------------------------------------------------
        */
        $submissionCurrency = $submission->currency ?? 'INR';
        $usdRate = CurrencyHelper::usdRate();

        $offeredPriceINR = CurrencyHelper::convert(
            $basePrice,
            $submissionCurrency,
            'INR',
            $usdRate
        );

        // GST handling
        $igstRate = Setting::where('key', 'igst')->value('value') ?? 18;
        $cgstRate = Setting::where('key', 'cgst')->value('value') ?? 9;
        $sgstRate = Setting::where('key', 'sgst')->value('value') ?? 9;

        $BuyerState = optional($user)->state;
        $adminState = Setting::where('key', 'billing_state')->value('value');

        $igst = $cgst = $sgst = 0;
        if ($BuyerState && $adminState && $BuyerState == $adminState) {
            $cgst = ($offeredPriceINR * $cgstRate) / 100;
            $sgst = ($offeredPriceINR * $sgstRate) / 100;
        } else {
            $igst = ($offeredPriceINR * $igstRate) / 100;
        }

        $totalAmount = $offeredPriceINR + $igst + $cgst + $sgst;

        DB::beginTransaction();
        try {
            // ✅ Create Product Order
            do {
                $orderNumber = 'PRO' . mt_rand(100000, 999999);
            } while (ProductOrder::where('order_number', $orderNumber)->exists());


            // ✅ Commission handling
            $customer = Customer::find($submission->customer_id);
            $commissionRate = $customer->commission_rate
                ?? setting('default_commission', 10);

            $commissionAmount = ($offeredPriceINR * $commissionRate) / 100;
            $sellerEarning = $offeredPriceINR - $commissionAmount;


            // ✅ Create Product Order
            $order = ProductOrder::create([
                'customer_id' => $user->id,
                'seller_id' => $submission->customer_id,
                'submission_id' => $submission->id,
                'order_number' => $orderNumber,
                'amount' => $offeredPriceINR,
                'igst' => $igst,
                'cgst' => $cgst,
                'sgst' => $sgst,
                'total' => $totalAmount,
                'commission_rate' => $commissionRate,
                'commission_amount' => $commissionAmount,
                'seller_earning' => $sellerEarning,
            ]);


            // ⚡ Create initial "recent" status for the order
            OrderStatus::create([
                'product_order_id' => $order->id,
                'status' => 'recent',
                'remarks' => 'Order just placed',
            ]);

            // ⚡ Wallet Payment
            if ($request->payment_method === 'wallet') {
                $wallet = $user->wallet;

                if (!$wallet || $wallet->balance < $totalAmount) {
                    return response()->json(['success' => false, 'message' => 'Insufficient wallet balance']);
                }


                // Deduct buyer wallet
                $wallet->balance -= $totalAmount;
                $wallet->save();

                $wallet->addTransaction('debit', $totalAmount, 'Purchase Products', 'Payment for order ' . $order->order_number);
                $order->update(['paid_at' => now()]);

                sendNotification('wallet_debit', [
                    'amount' => $totalAmount,
                    'balance' => $wallet->balance,
                ], $submission->customer_id);

                Payment::create([
                    'product_order_id' => $order->id,
                    'gateway' => 'wallet',
                    'payment_id' => 'WALLET-' . uniqid(),
                    'amount' => $totalAmount,
                    'currency' => 'INR',
                    'status' => 'success',
                ]);

                // ✅ Credit seller wallet
                $this->creditSellerWallet($order);
            }

            // ⚡ Razorpay Payment
            if ($request->payment_method === 'pay_online') {
                $razorpayPaymentId = $request->input('razorpay_payment_id');
                if (!$razorpayPaymentId) {
                    return response()->json(['success' => false, 'message' => 'Payment ID missing']);
                }

                // TODO: Razorpay signature verification

                $order->update(['paid_at' => now()]);

                Payment::create([
                    'product_order_id' => $order->id,
                    'gateway' => 'razorpay',
                    'payment_id' => $razorpayPaymentId,
                    'amount' => $totalAmount,
                    'currency' => 'INR',
                    'status' => 'success',
                ]);

                // ✅ Credit seller wallet
                $this->creditSellerWallet($order);
            }


            // Generate invoice number (INV + 6 random digits)
            $invoiceNumber = $this->generateUniqueInvoiceNumber();

            // ✅ Create Invoice
            Invoice::create([
                'product_order_id' => $order->id,
                'invoice_number' => $invoiceNumber,
                'amount' => $totalAmount,
                'currency' => 'INR',
                'issued_at' => now(),
            ]);



            sendNotification('order_placed', [
                'order_id' => $orderNumber,
                'amount' => $totalAmount,
            ], $user->id);

            sendNotification('new_order_received', [
                'listing_title' => $order->product_title,
                'order_id' => $orderNumber,
                'customer_name' => $order->customer->first_name,
            ], $order->seller_id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully.',
                'redirect_url' => route('orders.thank-you', ['order' => $order->id]),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Order failed: ' . $e->getMessage()]);
        }
    }

    private function creditSellerWallet($order)
    {
        $seller = $order->seller;
        if (!$seller)
            return;

        $sellerWallet = $seller->wallet ?: $seller->wallet()->create(['balance' => 0]);

        $sellerWallet->balance += $order->seller_earning;
        $sellerWallet->save();

        $sellerWallet->addTransaction(
            'credit',
            $order->seller_earning,
            'Product Sales',
            'Earning from order ' . $order->order_number
        );

        sendNotification('wallet_credit', [
            'amount' => $order->seller_earning,
            'balance' => $sellerWallet->balance,
        ], $order->seller_id);

    }



    private function generateUniqueInvoiceNumber()
    {
        // Get prefix
        $prefix = setting('invoice_prefix', 'INV');

        // Case 1: Serial Numbering (if not using random digits)
        if (setting('invoice_serial') && !setting('use_random_digits')) {
            $serial = (int) setting('invoice_serial');

            do {
                $number = $prefix . str_pad($serial, 6, '0', STR_PAD_LEFT);

                // Add financial year if enabled
                if (setting('include_financial_year')) {
                    $number .= '/' . $this->getFinancialYear();
                }

                $serial++;
            } while (Invoice::where('invoice_number', $number)->exists());

            // Save updated serial back to DB
            Setting::updateOrCreate(
                ['key' => 'invoice_serial'],
                ['value' => $serial]
            );

            return $number;
        }

        // Case 2: Random Digits
        $digits = (int) setting('invoice_random_digits', 6);

        do {
            $randomPart = str_pad(mt_rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
            $number = $prefix . $randomPart;

            if (setting('include_financial_year')) {
                $number .= '/' . $this->getFinancialYear();
            }

        } while (Invoice::where('invoice_number', $number)->exists());

        return $number;
    }

    /**
     * Get current financial year in format 24-25
     */
    private function getFinancialYear()
    {
        $year = (int) date('y');
        $month = (int) date('m');

        if ($month >= 4) {
            return $year . '-' . sprintf("%02d", $year + 1);
        }

        return sprintf("%02d", $year - 1) . '-' . $year;
    }


    public function thankYou($orderId = null)
    {
        $order = $orderId ? ProductOrder::with('invoice', 'payment')->find($orderId) : null;
        return view('front.thank-you', compact('order'));
    }


}

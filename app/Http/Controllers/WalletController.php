<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WalletWithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{

    public function index()
    {
        $wallets = Wallet::with('customer')->get();
        return view('admin.wallets.index', compact('wallets'));
    }

    // Show transactions of a specific wallet
    public function transactions(Wallet $wallet)
    {
        $transactions = $wallet->transactions()->latest()->get();
        return view('admin.wallets.transactions', compact('wallet', 'transactions'));
    }

    public function sellerPayout()
    {
        // Fetch all approved withdrawal requests (payouts) with customer & payment method details
        $requests = WalletWithdrawalRequest::with(['customer', 'paymentMethod'])
            ->where('status', 'approved')  // Only approved payouts
            ->latest()
            ->paginate(20);

        return view('admin.wallets.seller-payouts', compact('requests'));
    }

    public function withdrawalRequests()
    {
        // Fetch all withdrawal requests with customer & payment method details
        $requests = WalletWithdrawalRequest::with(['customer', 'paymentMethod'])
            ->where('status', '!=', 'approved')
            ->latest()
            ->paginate(20); // adjust pagination as needed

        return view('admin.wallets.withdrawal-requests', compact('requests'));
    }

    public function addFunds(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'amount' => 'required|numeric|min:1', // amount in paise
        ]);

        $user = Auth::guard('customer')->user();

        $wallet = $user->wallet ?? $user->wallet()->create([
            'balance' => 0,
            'currency' => 'INR',
            'status' => 'active',
        ]);

        // 🔥 Convert paise → rupees
        $amountInRupees = $request->amount / 100;

        $transaction = $wallet->addTransaction(
            'credit',
            $amountInRupees, // ✅ now correct
            'Money Added to Wallet',
            'Added funds via Razorpay',
            $request->razorpay_payment_id
        );

        sendNotification('wallet_credit', [
            'amount' => $amountInRupees,
            'balance' => $wallet->balance,
        ], $user->id);

        if ($transaction) {
            return response()->json([
                'success' => true,
                'message' => 'Wallet topped up successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to add funds to wallet'
        ], 500);
    }



    public function wallet()
    {
        $user = auth()->guard('customer')->user();
        $wallet = Wallet::firstOrCreate(['customer_id' => $user->id], ['balance' => 0]);
        $methods = $user->paymentMethods()->get();

        // Calculate balances (example properties, adjust as needed)
        $availableBalance = $wallet->balance;
        $escrowBalance = $wallet->escrow_balance ?? 0;     // if you track separately
        $pendingBalance = $wallet->pending_balance ?? 0;   // if you track separately
        $totalTransactions = $wallet->transactions()->count();

        $transactions = $wallet->transactions()->latest()->get();
        // dd($transactions->toArray());
        return view('user.wallet', compact(
            'availableBalance',
            'escrowBalance',
            'pendingBalance',
            'totalTransactions',
            'transactions',
            'methods'
        ));
    }


    public function withdrawStore(Request $request)
    {
        $request->validate([
            'method' => 'required|in:bank,upi,wire,paypal',
            'amount' => 'required|numeric|min:100',
        ]);

        $methodType = $request->get('method');
        $user = auth()->guard('customer')->user();
        $wallet = Wallet::where('customer_id', $user->id)->firstOrFail();

        // Ensure enough balance
        if ($request->amount > $wallet->balance) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient wallet balance'
            ]);
        }

        DB::beginTransaction();
        try {
            // Save payment method
            $paymentMethod = PaymentMethod::updateOrCreate(
                [
                    'customer_id' => $user->id,
                    'type' => $methodType
                ],
                $request->only([
                    'account_holder_name',
                    'account_number',
                    'ifsc_code',
                    'bank_name',
                    'branch_name',
                    'receiver_name',
                    'upi_id',
                    'swift_code',
                    'iban_number',
                    'paypal_email'
                ])
            );

            // Create withdrawal request
            $withdrawal = WalletWithdrawalRequest::create([
                'customer_id' => $user->id,
                'payment_method_id' => $paymentMethod->id,
                'amount' => $request->amount,
                'status' => 'pending',
            ]);

            // Move balance to hold
            $wallet->balance -= $request->amount;
            $wallet->hold_balance += $request->amount;
            $wallet->save();

            // Record transaction
            $wallet->addTransaction(
                'hold',
                $request->amount,
                'withdrawal',
                'Withdrawal request (pending) via ' . ucfirst($methodType),
                $withdrawal->id
            );

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }



    public function approveWithdrawal(Request $request, $id)
    {
        $withdrawal = WalletWithdrawalRequest::with('customer.wallet')->findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'This request is already processed.');
        }

        $request->validate([
            'payment_date' => 'required|date',
            'reference_id' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'screenshot' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $screenshotPath = null;
            if ($request->hasFile('screenshot')) {
                $screenshotPath = $request->file('screenshot')->store('withdrawal_screenshots', 'public');
            }

            $withdrawal->update([
                'status' => 'approved',
                'processed_at' => now(),
                'processed_by' => auth()->id(),
                'payment_date' => $request->payment_date,
                'reference_id' => $request->reference_id,
                'remarks' => $request->remarks,
                'screenshot' => $screenshotPath,
            ]);

            // Deduct from hold_balance
            $wallet = $withdrawal->customer->wallet;
            if ($wallet && $wallet->hold_balance >= $withdrawal->amount) {
                $wallet->decrement('hold_balance', $withdrawal->amount);
            }

            DB::commit();
            return back()->with('success', 'Withdrawal approved successfully with payment details.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


    public function rejectWithdrawal($id)
    {
        $request = WalletWithdrawalRequest::with('customer.wallet')->findOrFail($id);

        if ($request->status !== 'pending') {
            return back()->with('error', 'This request is already processed.');
        }

        DB::beginTransaction();
        try {
            // Mark as rejected
            $request->update([
                'status' => 'rejected',
                'processed_at' => Carbon::now(),
                'processed_by' => auth()->id(),
            ]);

            $wallet = $request->customer->wallet;

            // Return hold balance back to available balance
            if ($wallet->hold_balance >= $request->amount) {
                $wallet->decrement('hold_balance', $request->amount);
                $wallet->increment('balance', $request->amount);
            }

            DB::commit();
            return back()->with('success', 'Withdrawal rejected and funds returned.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


}


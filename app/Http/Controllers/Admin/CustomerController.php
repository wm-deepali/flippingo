<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // List all customers
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('admin.customers.index')->with('error', 'Customer not found.');
        }

        return view('admin.customers.view', compact('customer'));
    }

    public function updateCommission(Request $request, Customer $customer)
    {
        $request->validate([
            'commission_rate' => 'required|numeric|min:0|max:100',
        ]);

        $customer->commission_rate = $request->commission_rate;
        $customer->save();

        return redirect()->back()->with('success', 'Commission updated successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'mobile' => 'nullable|string|max:20',
            'account_type' => 'nullable|string|in:individual,entity',
            'status' => 'nullable|string|in:active,inactive,suspended',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
        ]);


        $customer->update($request->only([
            'first_name',
            'last_name',
            'display_name',
            'account_type',
            'legal_name',
            'email',
            'mobile',
            'whatsapp_number',
            'full_address',
            'city',
            'state',
            'zip_code',
            'status',
            'commission_rate',
        ]));

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }


    public function updatePassword(Request $request, Customer $customer)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $customer->password = bcrypt($request->password);
        $customer->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }


    // Delete customer
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();
            return response()->json(['success' => true, 'message' => 'Customer deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
    }

    public function allSellersIncomeDetail()
    {
        // Only sellers who have submissions/orders
        $sellers = Customer::whereHas('submissions') // Only sellers with submissions
            ->get();

        $data = $sellers->map(function ($seller) {
            $orders = ProductOrder::where('seller_id', $seller->id)->get();

            // Sum the seller_earning column directly
            $sellerEarnings = $orders->sum('seller_earning');

            return [
                'seller' => $seller,
                'orders' => $orders,
                'total_earnings' => $sellerEarnings,
            ];
        });

        return view('admin.customers.all_sellers_income', compact('data'));
    }
    public function allAdminCommissionIncome()
    {
        $sellers = Customer::whereHas('submissions') // Only sellers with submissions
            ->get();

        $data = $sellers->map(function ($seller) {
            $orders = ProductOrder::where('seller_id', $seller->id)->get();

            $adminIncome = $orders->sum('commission_amount');

            return [
                'seller' => $seller,
                'orders' => $orders,
                'total_admin_income' => $adminIncome,
            ];
        });

        return view('admin.customers.all_admin_commission', compact('data'));
    }


    public function kycBank(Customer $customer)
    {
        $customer->load([
            'kyc',
            'paymentMethods',
            'countryname'
        ]);

        return view('admin.customers.kyc-bank', compact('customer'));
    }


    public function verify(Request $request, Customer $customer)
    {
        $customer->verification_note = $request->verification_note;

        if ($request->has('change_status')) {
            // Switch ON → Verify
            $customer->is_verified = true;
            $customer->verified_at = now();
        } else {
            // Switch OFF → Unverify
            $customer->is_verified = false;
            $customer->verified_at = null;
        }

        $customer->save();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Verification details updated.');
    }


}

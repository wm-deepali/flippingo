<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    // View customer details (AJAX)
// View customer full page
    public function view($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('admin.customers.index')->with('error', 'Customer not found.');
        }

        return view('admin.customers.view', compact('customer'));
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
}

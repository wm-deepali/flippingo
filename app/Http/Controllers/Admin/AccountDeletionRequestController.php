<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountDeletionRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Auth;

class AccountDeletionRequestController extends Controller
{
    // List all deletion requests
    public function index()
    {
        $requests = AccountDeletionRequest::with('customer')->orderBy('created_at', 'desc')->get();
        return view('admin.account_deletion_requests.index', compact('requests'));
    }

    // Instant delete customer
    public function deleteInstant($id)
    {
        $request = AccountDeletionRequest::findOrFail($id);

        $customer = $request->customer;
        if ($customer) {
            $customer->delete(); // hard delete or soft delete if needed
            $request->update(['status' => 'approved']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Customer account deleted successfully.'
        ]);
    }


}

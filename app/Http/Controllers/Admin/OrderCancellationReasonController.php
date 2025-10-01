<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCancellationReason;

class OrderCancellationReasonController extends Controller
{
    // List all cancellation reasons
    public function index()
    {
        $reasons = OrderCancellationReason::orderBy('created_at', 'desc')->get();
        return view('admin.order_cancellation_reasons.index', compact('reasons'));
    }

    // Show form to create a new reason
    public function create()
    {
        return response()->json([
            "success" => true,
            "html" => view('admin.order_cancellation_reasons.create')->render(),
        ]);
    }

    // Store a new reason
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        OrderCancellationReason::create([
            'reason' => $request->reason,
        ]);

        return response()->json([
            'success' => true,
            'msgText' => 'Cancellation reason added successfully.',
        ]);
    }

    // Show form to edit a reason
    public function edit($id)
    {
        $reason = OrderCancellationReason::findOrFail($id);

        return response()->json([
            "success" => true,
            "html" => view('admin.order_cancellation_reasons.edit', compact('reason'))->render(),
        ]);
    }

    // Update a reason
    public function update(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $reason = OrderCancellationReason::findOrFail($id);
        $reason->update(['reason' => $request->reason]);

        return response()->json([
            'success' => true,
            'msgText' => 'Cancellation reason updated successfully.',
        ]);
    }

    // Delete a reason
    public function destroy($id)
    {
        $reason = OrderCancellationReason::findOrFail($id);
        $reason->delete();

        return response()->json([
            'success' => true,
            'msgText' => 'Cancellation reason deleted successfully.',
        ]);
    }
}

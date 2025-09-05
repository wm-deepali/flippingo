<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeletionReason;

class DeletionReasonController extends Controller
{
    // List all reasons
    public function index()
    {
        $reasons = DeletionReason::orderBy('created_at', 'desc')->get();
        return view('admin.deletion_reasons.index', compact('reasons'));
    }

    // Show form to create reason
    public function create()
    {
        return response()->json([
            "success" => true,
            "html" => view('admin.deletion_reasons.create')->render(),
        ]);
    }

    // Store new reason
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        DeletionReason::create([
            'reason' => $request->reason,
        ]);

        return response()->json([
            'success' => true,
            'msgText' => 'Reason added successfully.',
        ]);
    }

    // Show form to edit reason
    public function edit($id)
    {
        $reason = DeletionReason::findOrFail($id);
        // dd($reason->reason);
        return response()->json([
            "success" => true,
            "html" => view('admin.deletion_reasons.edit')->with([
                'reason' => $reason
            ])->render(),
        ]);
    }

    // Update reason
    public function update(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $reason = DeletionReason::findOrFail($id);
        $reason->update(['reason' => $request->reason]);

        return response()->json([
            'success' => true,
            'msgText' => 'Reason updated successfully.',
        ]);
    }

    // Delete reason
    public function destroy($id)
    {
        $reason = DeletionReason::findOrFail($id);
        $reason->delete();

        return response()->json([
            'success' => true,
            'msgText' => 'Reason deleted successfully.',
        ]);
    }
}

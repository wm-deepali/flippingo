<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package = Package::findOrFail($id);

        return view('admin.packages.show', compact('package'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mrp' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'listings' => 'nullable|integer',
            'listings_display' => 'nullable|string|max:255',
            'listing_duration' => 'nullable|integer',
            'listing_duration_unit' => 'nullable|in:days,months',
            'listing_duration_display' => 'nullable|string|max:255',
            'validity' => 'nullable|integer',
            'validity_unit' => 'nullable|in:days,months',
            'validity_display' => 'nullable|string|max:255',
            'sponsored' => 'nullable|in:yes,no',
            'sponsored_frequency' => 'nullable|integer',
            'sponsored_unit' => 'nullable|in:days,weeks,months',
            'sponsored_display' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|in:yes,no',
            'whatsapp_frequency' => 'nullable|integer',
            'whatsapp_unit' => 'nullable|in:days,weeks,months',
            'whatsapp_display' => 'nullable|string|max:255',
            'alerts' => 'required|in:yes,no',
            'alerts_display' => 'nullable|string|max:255',
            'is_popular' => 'required|in:0,1', // dropdown
            'status' => 'required|in:active,inactive',
            'is_verified_seller' => 'nullable|boolean',
            'is_premium_seller' => 'nullable|boolean',
        ]);

        // calculate offered price
        $data['offered_price'] = $data['mrp'] - ($data['mrp'] * ($data['discount'] ?? 0) / 100);

        // cast dropdowns correctly
        $data['is_popular'] = (int) $request->input('is_popular');

        // ✅ Handle checkboxes
        $data['is_verified_seller'] = $request->has('is_verified_seller');
        $data['is_premium_seller'] = $request->has('is_premium_seller');

        Package::create($data);

        return response()->json(['success' => true]);
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'mrp' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'listings' => 'nullable|integer',
            'listings_display' => 'nullable|string|max:255',
            'listing_duration' => 'nullable|integer',
            'listing_duration_unit' => 'nullable|in:days,months',
            'listing_duration_display' => 'nullable|string|max:255',
            'validity' => 'nullable|integer',
            'validity_unit' => 'nullable|in:days,months',
            'validity_display' => 'nullable|string|max:255',
            'sponsored' => 'nullable|in:yes,no',
            'sponsored_frequency' => 'nullable|integer',
            'sponsored_unit' => 'nullable|in:days,weeks,months',
            'sponsored_display' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|in:yes,no',
            'whatsapp_frequency' => 'nullable|integer',
            'whatsapp_unit' => 'nullable|in:days,weeks,months',
            'whatsapp_display' => 'nullable|string|max:255',
            'alerts' => 'required|in:yes,no',
            'alerts_display' => 'nullable|string|max:255',
            'is_popular' => 'required|in:0,1',
            'status' => 'required|in:active,inactive',
            'is_verified_seller' => 'nullable|boolean',
            'is_premium_seller' => 'nullable|boolean',
        ]);

        $data['offered_price'] = $data['mrp'] - ($data['mrp'] * ($data['discount'] ?? 0) / 100);
        $data['is_popular'] = (int) $request->input('is_popular');

        // ✅ Reset correctly when unchecked
        $data['is_verified_seller'] = $request->has('is_verified_seller');
        $data['is_premium_seller'] = $request->has('is_premium_seller');

        $package->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy(Package $package)
    {
        if ($package) {
            $package->delete();
            return response()->json(['success' => true, 'message' => 'Package deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Package not found'], 404);

    }


}

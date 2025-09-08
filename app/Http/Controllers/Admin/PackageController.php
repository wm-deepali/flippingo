<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
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
            'listing_duration' => 'nullable|integer',
            'validity' => 'nullable|integer',
            'promotions' => 'nullable|integer',
            'sponsors_days' => 'nullable|integer',
            'alerts' => 'required|in:yes,no',
            'is_popular' => 'nullable|boolean',
            'status' => 'required|in:active,inactive', // ✅ added
        ]);

        $data['offered_price'] = $data['mrp'] - ($data['mrp'] * ($data['discount'] ?? 0) / 100);
        $data['is_popular'] = $request->has('is_popular');

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully');
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
            'listing_duration' => 'nullable|integer',
            'validity' => 'nullable|integer',
            'promotions' => 'nullable|integer',
            'sponsors_days' => 'nullable|integer',
            'alerts' => 'required|in:yes,no',
            'is_popular' => 'nullable|boolean',
            'status' => 'required|in:active,inactive', // ✅ added
        ]);

        $data['offered_price'] = $data['mrp'] - ($data['mrp'] * ($data['discount'] ?? 0) / 100);
        $data['is_popular'] = $request->has('is_popular');

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully');
    }
}

@extends('layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Manage Packages</a></li>
                                <li class="breadcrumb-item active">View Package</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary btn-round btn-sm">Back</a>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{ $package->name }} (Details)</h4>
                        </div>
                        <div class="card-body mt-2">
                            <table class="table table-bordered">
                                <tr><th>Package Name</th><td>{{ $package->name }}</td></tr>
                                <tr><th>MRP</th><td>{{ $package->mrp }}</td></tr>
                                <tr><th>Discount (%)</th><td>{{ $package->discount ?? 0 }}</td></tr>
                                <tr><th>Offered Price</th><td>{{ $package->offered_price }}</td></tr>
                                <tr><th>Status</th>
                                    <td>
                                        @if($package->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Popular</th><td>{{ $package->is_popular ? 'Yes' : 'No' }}</td></tr>
                                <tr><th>Total Sales</th><td>{{ $package->total_sales ?? '0'}}</td></tr>
                            </table>

                            <h5 class="mt-3 mb-2">Subscription Features</h5>
                            <table class="table table-bordered">
                                <tr><th>Number of Listings</th><td>{{ $package->listings_display ?? $package->listings }}</td></tr>
                                <tr><th>Listing Duration</th><td>{{ $package->listing_duration_display ?? $package->listing_duration . ' ' . $package->listing_duration_unit }}</td></tr>
                                <tr><th>Validity</th><td>{{ $package->validity_display ?? $package->validity . ' ' . $package->validity_unit }}</td></tr>
                                <tr><th>Sponsored</th><td>{{ $package->sponsored_display ?? ($package->sponsored == 'yes' ? 'Yes' : 'No') }}</td></tr>
                                <tr><th>WhatsApp Sharing</th><td>{{ $package->whatsapp_display ?? ($package->whatsapp == 'yes' ? 'Yes' : 'No') }}</td></tr>
                                <tr><th>Alerts</th><td>{{ $package->alerts_display ?? ($package->alerts == 'yes' ? 'Yes' : 'No') }}</td></tr>
                            </table>

                            <div class="text-right mt-2">
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

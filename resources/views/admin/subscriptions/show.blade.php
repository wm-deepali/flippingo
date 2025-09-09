@extends('layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-2">
                <div class="col-md-6">
                    <h4 class="mb-0">Order Details</h4>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">

                        {{-- Company Logo --}}
                        <div class="text-center mb-3">
                            <img src="{{ asset('admin_assets/images/logo.png') }}" alt="Logo"
                                style="height: 60px;padding:10px;background:#000;border-radius:4px;">
                        </div>

                        {{-- Order ID + Status --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5><strong>Order ID:</strong>{{ $subscription->order_number }}</h5>
                                <h5>
                                    <strong>Payment Status:</strong>
                                    <span class="badge badge-success">Paid</span>
                                </h5>
                                <h5>
                                    <strong>Subscription Status:</strong>
                                     @switch($subscription->status)
        @case('active')
            <span class="badge badge-primary">Active</span>
            @break
        @case('expired')
            <span class="badge badge-secondary">Expired</span>
            @break
        @case('cancel_requested')
            <span class="badge badge-warning">Cancel Requested</span>
            @break
        @case('cancelled')
            <span class="badge badge-danger">Cancelled</span>
            @break
        @default
            <span class="badge badge-light">{{ ucfirst($sub->status) }}</span>
    @endswitch
                                </h5>
                            </div>
                        </div>

                        {{-- Customer & Company Info --}}
                        <div class="row border p-3 mb-4">
                            <div class="col-md-6">
                                <h5><strong>Customer Info</strong></h5>
                                <p><strong>Name:</strong> {{ $subscription->customer->first_name ?? '' }}
                                    {{ $subscription->customer->last_name ?? '' }}
                                </p>
                                <p><strong>Contact:</strong> {{   $subscription->customer->mobile ?? '' }}</p>
                                <p><strong>Email:</strong>{{ $subscription->customer->email ?? '' }}</p>
                                <p><strong>Delivery Address:</strong>{{  $subscription->customer->full_address ?? ''  }}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5><strong>Company Info</strong></h5>
                                <p><strong>Name:</strong> My Company Name</p>
                                <p><strong>Contact:</strong> 0-00-000-000</p>
                                <p><strong>Email:</strong> yourcompany@gmail.com</p>
                                <p><strong>Address:</strong> Company Street, NY 1001-234</p>
                                <p><strong>Website:</strong> www.company.com</p>
                            </div>
                        </div>

                        {{-- Quote Items --}}
                        <h5 class="mb-2">Quote Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 60%;">Detail</th>
                                        <th style="width: 20%;">Quantity</th>
                                        <th style="width: 20%;">Price (£)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $subscription->package->name }}</td>
                                        <td>{{ 1 }}</td>
                                        <td>{{ number_format($subscription->package->offered_price, 2) }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        {{-- Summary --}}
                        <div class="row justify-content-end mt-4">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td class="text-right">£{{ number_format($subscription->package->offered_price ?? 0, 2) }}</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Delivery Charge:</th>
                                        <td class="text-right">£10.00</td>
                                    </tr>
                                    <tr>
                                        <th>VAT (20%):</th>
                                        <td class="text-right">£23.00</td>
                                    </tr> -->
                                    <tr class="border-top">
                                        <th><strong>Grand Total:</strong></th>
                                        <td class="text-right"><strong>£{{ number_format($subscription->package->offered_price ?? 0, 2) }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        {{-- Customer Documents --}}
                        <!-- <h5>Customer Documents</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th>Remarks / Title</th>
                                        <th>Thumbnail</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Design File</td>
                                        <td><img src="{{ asset('admin_assets/images/pdf.png') }}" width="40" alt="PDF" />
                                        </td>
                                        <td><a href="#" class="btn btn-sm btn-info" target="_blank">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Sample Image</td>
                                        <td><img src="{{ asset('admin_assets/images/logo.png') }}" width="80" /></td>
                                        <td><a href="#" class="btn btn-sm btn-info" target="_blank">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->

                        {{-- Action Buttons --}}
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-2">
                                <a href="#" class="btn btn-primary btn-block">Download PDF</a>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-block">Send Email</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
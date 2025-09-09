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
                                    <li class="breadcrumb-item active">Manage Orders</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orders Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="orders-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Order ID</th>
                                                <th>Seller Info</th>
                                                <th>Transaction ID</th>
                                                <th>Payment Method</th>
                                                <th>Payment Status</th>
                                                <th>Subscription Status</th>
                                                <th>Subscription Expiry</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subscriptions as $sub)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i') }}</td>
                                                    <td>#ORD{{ $sub->id }}</td>
                                                    <td>
                                                        Seller ID: {{ $sub->customer->id ?? '-' }}<br>
                                                       {{ $sub->customer->first_name ?? '-' }} {{ $sub->customer->last_name ?? '-' }}<br>
                                                        {{ $sub->customer->email ?? '-' }}
                                                    </td>
                                                     <td>{{ $sub->payment->payment_id ?? '-' }}</td>
                                                     <td>{{ ucfirst($sub->payment->gateway ?? '-') }}</td>
                                                    <td>
                                                        @if($sub->payment->status === 'success')
                    <span class="badge badge-success">Paid</span>
                @elseif($sub->payment->status === 'pending')
                    <span class="badge badge-warning">Pending</span>
                @else
                    <span class="badge badge-danger">Failed</span>
                @endif
                                                    </td>
                                                    <td>
                                                        @if($sub->status === 'active')
                                                            <span class="badge badge-primary">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($sub->end_date)->format('Y-m-d') }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-secondary">View Order Detail</button>
                                                        <button class="btn btn-sm btn-info">View Seller Detail</button>
                                                        <button class="btn btn-sm btn-primary">Download Invoice</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
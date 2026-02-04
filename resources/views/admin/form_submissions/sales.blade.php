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
                                    <li class="breadcrumb-item active">All Sales Listing:
                                    </li>
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
                                <h4>All Sales for Submission: {{ $submission->product_title }}</h4>
                            </div>
                            <div class="card-body">
                                <p>Seller: {{ $submission->customer->first_name ?? '' }} {{ $submission->customer->last_name ?? '' }}</p>
  <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Order ID</th>
                            <th>Buyer Info</th>
                            <th>Paid Amount</th>
                            <th>Payment Method</th>
                            <th>Commission</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                        @php $status = $order->currentStatus->status ?? 'N/A'; @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ $order->order_number }}</td>

                                <!-- Buyer Info -->
                                <td>
                                    Buyer ID: {{ $order->customer->id ?? '-' }}<br>
                                    {{ $order->customer->first_name ?? '-' }} {{ $order->customer->last_name ?? '-' }}<br>
                                    {{ $order->customer->email ?? '-' }}
                                </td>

                                <!-- Product Cost -->
                                <td>₹{{ $order->total ?? '-' }}</td>

                                <!-- Payment Method -->
                                <td>{{ ucfirst($order->payment->gateway ?? '-') }}</td>

                                  <td>{{ $order->commission_amount ?? '-' }}</td>

                                  <td>
                        @switch($status)
                            @case('recent')
                                <span class="badge badge-primary">Recent</span>
                                @break
                            @case('approved')
                                <span class="badge badge-secondary">Approved</span>
                                @break
                            @case('processing')
                                <span class="badge badge-info">Processing</span>
                                @break
                            @case('delivered')
                                <span class="badge badge-success">Delivered</span>
                                @break
                            @case('cancel_requested')
                                <span class="badge badge-warning">Cancel Requested</span>
                                @break
                            @case('cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>

                     <td>
                        <a href="{{ route('admin.product-orders.show', $order->id) }}" class="btn btn-sm btn-secondary">
                            View Order Detail
                        </a>

                 
                        <a href="{{ route('admin.customers.show', $order->seller_id) }}" target="_blank" class="btn btn-sm btn-primary">
                            View Buyer Info
                        </a>

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
@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Order Details' }}
@endsection

<style>
    .order-invoice {
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

</style>

@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="order-invoice">
          
            <div class="card">
                <div class="card-body">

                    {{-- Company Logo --}}
                    <div class="text-center mb-3">
                        @if(setting('billing_logo'))
                            <img src="{{ asset('storage/' . setting('billing_logo')) }}" alt="Logo"
                                style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                        @else
                            <img src="{{ asset('admin_assets/images/logo.png') }}" alt="Logo"
                                style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                        @endif
                    </div>

                    {{-- Order ID + Status --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><strong>Order ID:</strong> {{ $order->order_number }}</h5>
                            <h5>
                                <strong>Payment Status:</strong>
                                <span class="badge badge-success">Paid</span>
                            </h5>
                            <h5>
                                <strong>Order Status:</strong>
                                @php $status = $order->currentStatus->status ?? 'N/A'; @endphp
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
                            </h5>
                        </div>
                    </div>

                    {{-- Customer & Company Info --}}
                    <div class="row border p-3 mb-4">
                        <div class="col-md-6">
                            <h5><strong>Customer Info</strong></h5>
                            <p><strong>Name:</strong> {{ $order->customer->first_name ?? '' }} {{ $order->customer->last_name ?? '' }}</p>
                            <p><strong>Contact:</strong> {{ $order->customer->mobile ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $order->customer->email ?? '' }}</p>
                            <p><strong>Delivery Address:</strong> {{ $order->customer->full_address ?? '' }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <h5><strong>Company Info</strong></h5>
                            <p><strong>Name:</strong> {{ setting('billing_website', 'Flippingo Private Limited') }}</p>
                            <p><strong>Contact:</strong> {{ setting('billing_contact', '+91 8809772278') }}</p>
                            <p><strong>Email:</strong> {{ setting('billing_email', 'support@flippingo.com') }}</p>
                            <p><strong>Address:</strong> {{ setting('billing_address', 'Old Palasia, Indore, MP, 452001, India') }}</p>
                            <p><strong>Website:</strong> {{ setting('billing_website', 'www.company.com') }}</p>
                        </div>
                    </div>

                    {{-- Quote Items --}}
                    <h5 class="mb-2">Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 60%;">Detail</th>
                                    <th style="width: 20%;">Quantity</th>
                                    <th style="width: 20%;">Price (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                  @php
                                        $subtotal = $order->product['offeredPrice'] ?? 0;
                                    @endphp
                                <tr>
                                    <td>
                                         {{ $order->product['productTitle'] }}
                                            @if($order->product['category'])
                                                <br><small>Category: {{ $order->product['category'] }}</small>
                                            @endif
                                            @if($order->product['productPhoto'])
                                                <br><img src="{{ asset('storage/' . $order->product['productPhoto']) }}" alt="Product Image"
                                                    width="80">
                                            @endif
                                        
                                    </td>
                                    <td>1</td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Commission & Seller Earning --}}
<div class="row justify-content- mb-3">
    <div class="col-md-5">
        <table class="table table-borderless">
            <tr>
                <th>Commission ({{ $order->commission_rate }}%):</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->commission_amount, 2) }}</td>
            </tr>
            <tr>
                <th>Seller Earning:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->seller_earning, 2) }}</td>
            </tr>
        </table>
    </div>
</div>

                   {{-- Summary / Financial Details --}}
<div class="row justify-content-end mt-4">
    <div class="col-md-5">
        <table class="table table-borderless">
            <tr>
                <th>Subtotal:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->amount, 2) }}</td>
            </tr>
            <tr>
                <th>IGST:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->igst, 2) }}</td>
            </tr>
            <tr>
                <th>CGST:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->cgst, 2) }}</td>
            </tr>
            <tr>
                <th>SGST:</th>
                <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->sgst, 2) }}</td>
            </tr>
            <tr class="border-top">
                <th><strong>Grand Total:</strong></th>
                <td class="text-right"><strong><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->total, 2) }}</strong></td>
            </tr>
            
        </table>
    </div>
</div>

   <hr>

                    {{-- Action Buttons --}}
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                        <a href="#" class="btn btn-primary btn-block">Download PDF</a>
                        </div>
                       
                    </div>

                </div>
            </div>
        
</div>
    </div>

@endsection

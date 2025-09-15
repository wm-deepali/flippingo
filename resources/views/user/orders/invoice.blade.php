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

  <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-0" style="font-weight:700;">INVOICE</h2>
                            <small class="text-muted" style="font-weight:600;">
                                {{ $order->invoice->invoice_number ?? '#INV-1001' }}
                            </small>
                        </div>
                        <div>
                            @if(setting('billing_logo'))
                                <img src="{{ asset('storage/' . setting('billing_logo')) }}" alt="Logo"
                                    style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                            @else
                                <img src="{{ asset('admin_assets/images/logo.png') }}" alt="Logo"
                                    style="height: 60px; padding:10px; background:#000; border-radius:4px;">
                            @endif
                        </div>
                    </div>

                    {{-- Info Section --}}
                    <div class="row border-top border-bottom mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong>Info</strong>
                            <hr>
                            <p><strong>Invoice Date:</strong>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>
                            <p><strong>Order Id:</strong> {{ $order->order_number }}</p>
                            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment->status ?? '-') }}</p>
                            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment->gateway ?? '-') }}</p>
                            <p><strong>Payment Date:</strong>
                                {{ \Carbon\Carbon::parse($order->payment->created_at ?? now())->format('d M, Y') }}</p>
                        </div>

                        <div class="col-md-4 border-left border-right p-2">
                            <strong>Billed to</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;">{{ $order->customer->first_name ?? '' }}
                                {{ $order->customer->last_name ?? '' }}
                            </p>
                            <p style="margin-bottom:6px;">{{ $order->customer->full_address ?? '' }}</p>
                            <p style="margin-bottom:4px;">{{ $order->customer->mobile ?? '' }}</p>
                            <p style="margin-bottom:6px; color:blue;">{{ $order->customer->email ?? '' }}</p>
                        </div>

                        <div class="col-md-4 p-2">
                            <strong>From</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;">
                                {{ setting('billing_website', 'Flippingo Private Limited') }}
                            </p>
                            <p style="margin-bottom:6px;">
                                {{ setting('billing_address', 'Old Palasia, Indore, MP, 452001, India') }}
                            </p>
                            <p style="margin-bottom:4px;">{{ setting('billing_contact', '+91 8809772278') }}</p>
                            <p style="color:blue;">{{ setting('billing_email', 'support@flippingo.com') }}</p>
                        </div>
                    </div>

                    {{-- Item Table --}}
                    <h5 class="mb-2">Item Summary</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 14px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Rate (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                                    <th>Total (<i class="fa-solid fa-indian-rupee-sign"></i>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                @endphp

                                @if($type === 'subscription' && $order->package)
                                    @php
                                        $subtotal = $order->package->offered_price ?? 0;
                                          $total = $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $order->package->name }}</td>
                                        <td>1</td>
                                        <td>{{ number_format($order->package->offered_price, 2) }}</td>
                                        <td>{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @elseif($type === 'product')
                                    @php
                                        $subtotal = $order->product['offeredPrice'] ?? 0;
                                        $total = $order->total;
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
                                        <td>{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Totals --}}
                   
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                        {{ number_format($subtotal, 2) }}</td>
                                </tr>
                                @if($type === 'product')
                                    <tr>
                                        <th>IGST:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ number_format($order->igst ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>CGST:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ number_format($order->cgst ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>SGST:</th>
                                        <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ number_format($order->sgst ?? 0, 2) }}</td>
                                    </tr>
                                @endif

                                <tr class="font-weight-bold"
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th>Total</th>
                                    <td class="text-right"><strong><i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ number_format($total, 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="{{ route('admin.invoice.download', ['type' => $type, 'id' => $order->id]) }}"
                                class="btn btn-outline-primary btn-block" target="_blank">Download Invoice</a>
                        </div>
                        
                    </div>

                </div>

        </div>
    </div>
@endsection
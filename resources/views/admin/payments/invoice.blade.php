@extends('layouts.master')

@section('content')
    <div class="app-content content mb-3">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card p-4 shadow-sm" style="max-width: 900px; margin: auto; background: #fff;">

                    {{-- Header Section --}}
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
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p><strong>Invoice Date:</strong>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>
                            <p><strong>Order Id:</strong> #ORD-{{ $order->id }}</p>
                            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment->status ?? '-') }}</p>
                            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment->gateway ?? '-') }}</p>
                            <p><strong>Payment Date:</strong>
                                {{ \Carbon\Carbon::parse($order->payment->created_at ?? now())->format('d M, Y') }}</p>
                        </div>


                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;">{{ $order->customer->first_name ?? '' }}
                                {{ $order->customer->last_name ?? '' }}
                            </p>
                            <p style="margin-bottom:6px;">{{  $order->customer->full_address ?? ''  }}</p>
                            <p style="margin-bottom:4px;">{{   $order->customer->mobile ?? '' }}</p>
                            <p style="margin-bottom:6px; color:blue;">{{ $order->customer->email ?? '' }}</p>
                        </div>
                        {{-- From (Invoice Settings via helper) --}}
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
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
                                    <th>Rate (<i class="fa-solid fa-indian-rupee-sign"></i> )</th>
                                    <th>Total (<i class="fa-solid fa-indian-rupee-sign"></i> )</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($type === 'subscription')
                                    <tr>
                                        <td>{{ $order->package->name }}</td>
                                        <td>{{ 1 }}</td>
                                        <td>{{ number_format($order->package->offered_price, 2) }}</td>
                                        <td>{{ number_format($order->package->offered_price, 2) }}</td>
                                    </tr>
                                @elseif($type === 'product')
                                    @foreach($order->products ?? [] as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->pivot->quantity ?? 1 }}</td>
                                            <td>{{ number_format($product->price, 2) }}</td>
                                            <td>{{ number_format(($product->pivot->quantity ?? 1) * $product->price, 2) }}</td>
                                        </tr>
                                    @endforeach
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
                                    <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->subtotal ?? 0, 2) }}</td>
                                </tr>
                                <!-- <tr>
                                            <th>Delivery Charge:</th>
                                            <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->delivery_charge ?? 0, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Proof Reading:</th>
                                            <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->proof_reading_charge ?? 0, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>VAT (20%):</th>
                                            <td class="text-right"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->vat ?? 0, 2) }}</td>
                                        </tr> -->
                                <tr class="font-weight-bold"
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Total</strong></th>
                                    <td class="text-right"><strong><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($order->total ?? 0, 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="{{ route('admin.invoice.download', ['type' => $type, 'id' => $order->id]) }}"
                                class="btn btn-outline-primary btn-block" target="_blank">
                                Download Invoice
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success btn-block">Send via Email</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
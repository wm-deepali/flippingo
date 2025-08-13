@extends('layouts.new-master')

@section('title')
    Flippingo ->My Orders
@endsection

<style>
    /* .container {
      max-width: 1200px;
      margin: auto;
    } */

    .main-content {
        display: flex;
        gap: 1.5rem;
    }

    .left,
    .right {
        background-color: #fff;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .left {
        flex: 2;
    }

    .right {
        flex: 1;
    }

    h3 {
        margin-top: 0;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .input-row {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .option-buttons button {
        padding: 0.5rem 1rem;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
        border-radius: 4px;
    }

    .option-buttons button.active {
        border: 2px solid #f42b5b;
    }

    .image-preview {
        background-color: #f0f0f0;
        height: 100px;
        width: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #666;
    }

    .thumbnail-list {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .thumbnail-list img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        border: 2px solid transparent;
    }

    .thumbnail-list img.selected {
        border-color: #f42b5b;
    }

    .slider-container {
        margin-top: 1rem;
    }

    input[type=range] {
        width: 100%;
    }

    .slider-values {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .delivery-box {
        border: 2px solid #f42b5b;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: #2e3c4d;
        color: white;
    }

    .delivery-box .best-value {
        color: gold;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
    }

    .design-options {
        display: flex;
        gap: 1rem;
        margin: 1rem 0;
    }

    .design-box {
        border: 1px solid #ccc;
        padding: 0.5rem;
        text-align: center;
        border-radius: 6px;
        flex: 1;
    }

    .btn-yellow {
        background-color: #ffcf00;
        border: none;
        padding: 0.75rem 1rem;
        width: 100%;
        font-weight: bold;
        cursor: pointer;
        border-radius: 6px;
        margin: 1rem 0;
    }

    .additional-links {
        font-size: 0.9rem;
        color: #555;
    }

    .additional-links a {
        color: #333;
        text-decoration: none;
    }

    .tab-container {
        margin-top: 1.5rem;
        background-color: #fff;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .tab-buttons {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .tab-buttons button {
        padding: 0.5rem 1rem;
        border: 1px solid #ccc;
        background-color: #f5f7fa;
        cursor: pointer;
        border-radius: 4px;
        font-weight: 500;
    }

    .tab-buttons button.active {
        background-color: #f42b5b;
        color: white;
        border-color: #f42b5b;
    }

    .tab-content {
        display: none;
        padding: 1rem;
        background-color: #f9f9f9;
        border-radius: 4px;
    }

    .tab-content.active {
        display: block;
    }
</style>
<style>
    .custom-invoice-table {
        width: 100%;
        font-size: 14px;
        border-collapse: collapse;
        background: #fff;
        color: #000;
    }

    .custom-invoice-table thead {
        background: #f0f0f0;
        font-weight: 600;
    }

    .custom-invoice-table th,
    .custom-invoice-table td {
        border: 1px solid #222;
        padding: 10px;
        vertical-align: middle;
    }

    .custom-invoice-table small {
        color: #555 !important;
    }

    .custom-total-table {
        width: 100%;
        font-size: 14px;
        color: #000;
        background: #fff;
    }

    .custom-total-table th,
    .custom-total-table td {
        padding: 10px;
        border: 1px solid #000;
    }

    .custom-total-table .highlight-row {
        border-top: 2px solid #6B3DF4;
        border-bottom: 2px solid #6B3DF4;
    }

    .custom-total-table .highlight-row th,
    .custom-total-table .highlight-row td {
        font-size: 16px;
        color: #6B3DF4;
        font-weight: 700;
    }
</style>

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom d-none d-md-flex">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">My Orders</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
                                            Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Account</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-5" style="background: #f8f9fa; font-family: 'Segoe UI', sans-serif;">
                <div class="container">
                    <div class="row">
                        <!-- Sidebar -->
                        @include('layouts.includes.user-sidebar', ['activeMenu' => 'orders'])

                        <!-- Invoice Section -->
                        <div class="col-lg-8">
                            <div class="bg-white p-4 shadow-sm">
                                <!-- Invoice Header -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <h3 class="mb-0" style="font-weight: 700;">INVOICE</h3>
                                        <small class="text-muted">#{{ $invoice->invoice_number ?? 'N/A' }}</small>
                                    </div>
                                    <img src="https://nuvem.tpmhelpinghand.com/public/admin_assets/images/logo.png"
                                        alt="Logo" style="height: 30px;">
                                </div>

                                <!-- Invoice Info Columns -->
                                <div class="d-flex   overflow-hidden mb-4"
                                    style="border-top: 1px solid #66666673; border-bottom: 1px solid #66666673;">
                                    <div class="col-4 p-3 border-right">
                                        <strong>Info</strong>
                                        <hr>
                                        <p class="mb-1"><strong>Invoice Date:</strong>
                                            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}</p>
                                        <p class="mb-1"><strong>Order ID:</strong> #{{ $quote->order_number }}</p>
                                        <p class="mb-1"><strong>Payment Status:</strong>
                                            {{ $payments->sum('amount_received') >= $quote->grand_total ? 'Paid' : 'Unpaid' }}
                                        </p>
                                        <p class="mb-1"><strong>Method:</strong>
                                            {{ $payments->last()->payment_method ?? 'N/A' }}</p>
                                        <p class="mb-0"><strong>Payment Date:</strong>
                                            {{ \Carbon\Carbon::parse($payments->last()->payment_date)->format('d M, Y') ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="col-4 p-3 border-right"
                                        style="border-left: 1px solid #66666673; border-right: 1px solid #66666673;">
                                        <strong>Billed to</strong>
                                        <hr>
                                        <p class="mb-1 font-weight-bold" style="font-weight: 600;">
                                            {{ $customer->first_name ?? '-'}}
                                            {{ $customer->last_name ?? '' }}
                                        </p>
                                        <p class="mb-1">{{ $quote->billingAddress->address }}</p>
                                        <p class="mb-1">{{ $customer->mobile ?? '' }}</p>
                                        <p class="text-primary mb-0">{{ $customer->email ?? '' }}</p>
                                    </div>
                                    <div class="col-4 p-3">
                                        <strong>From</strong>
                                        <hr>
                                        <p class="mb-1 font-weight-bold" style="font-weight: 600;">Flippingo</p>
                                        <p class="mb-1">Unit 7 Lotherton Way, Garforth, Leeds LS252JY</p>
                                        <p class="mb-1">01132 874724</p>
                                        <p class="text-primary mb-0">andy@nuvemprint.com</p>
                                    </div>
                                </div>

                                <!-- Invoice Items Table -->
                                <h5 class="mb-2">Item Summary</h5>
                                <div class="table-responsive">
                                    <table class="table custom-invoice-table">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Rate (£)</th>
                                                <th class="text-center">Total (£)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quote->items as $item)
                                                <tr>
                                                    <td>
                                                        {{-- Subcategory + Category --}}
                                                        <div style="font-weight: 600;">
                                                            {{ $item->subcategory->name ?? 'N/A' }}
                                                            ({{ optional($item->subcategory->categories->first())->name ?? 'N/A' }})
                                                        </div>

                                                        {{-- Attributes --}}
                                                        @if ($item->attributes && $item->attributes->count())
                                                            <div style="margin-top: 5px;">
                                                                @foreach ($item->attributes as $attr)
                                                                    <div style="font-size: 13px; margin-left: 8px;">
                                                                        <strong>{{ $attr->attribute->name ?? '' }}:</strong>
                                                                        @if ($attr->attributeValue)
                                                                            {{ $attr->attributeValue->value }}
                                                                        @elseif ($attr->length && $attr->width)
                                                                            {{ $attr->length }} x {{ $attr->width }} {{ $attr->unit }}
                                                                        @elseif ($attr->length)
                                                                            {{ $attr->length }} {{ $attr->unit }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                        {{-- Number of Pages --}}
                                                        @if (!is_null($item->pages))
                                                            <div style="margin-top: 5px; font-size: 13px; margin-left: 8px;">
                                                                <strong>Pages:</strong> {{ $item->pages }}
                                                            </div>
                                                        @endif

                                                    </td>

                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-center">
                                                        {{ $item->quantity > 0 ? number_format($item->sub_total / $item->quantity, 2) : '0.00' }}
                                                    </td>
                                                    <td class="text-center">{{ number_format($item->sub_total, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Totals Section -->
                                <div class="row justify-content-end mt-4">
                                    <div class="col-md-6">
                                        <table class="table custom-total-table">
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td class="text-right">
                                                    £{{ number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Delivery Charge:</th>
                                                <td class="text-right">£{{ number_format($quote->delivery_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Proof Reading:</th>
                                                <td class="text-right">£{{ number_format($quote->proof_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>VAT ({{ (int) $quote->vat_percentage }}%):</th>
                                                <td class="text-right">£{{ number_format($quote->vat_amount, 2) }}</td>
                                            </tr>
                                            <tr class="highlight-row">
                                                <th class="text-primary">Total:</th>
                                                <td class="text-right text-primary font-weight-bold">
                                                    £{{ number_format($quote->grand_total, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                                <!-- Action Buttons -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--end shop cart-->
        </div>
    </div>
@endsection
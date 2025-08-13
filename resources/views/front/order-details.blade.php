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


@section('content')
    <div class="page-wrapper" style="height:auto;">
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
            <section class="py-4">
                <div class="container">
                    <h3 class="d-none">Account</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('layouts.includes.user-sidebar', ['activeMenu' => 'orders'])
                                <div class="col-lg-8">
                                    <div class="card shadow-none mb-0">
                                        <div class="card-body">

                                            <!-- Order Header -->
                                            <h5 class="mb-3">Order Details</h5>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div><strong>Order ID:</strong> #{{ $quote->quote_number }}</div>
                                                <div>
                                                    <strong>Payment Status:</strong>
                                                    @if($quote->payments->isEmpty())
                                                        <span class="badge bg-danger">UnPaid</span>
                                                    @else
                                                        <span class="badge bg-success">Paid</span>
                                                    @endif
                                                </div>

                                            </div>

                                            <!-- Customer & Company Info -->
                                            <div class="row border p-3 mb-4">
                                                <div class="col-md-6">
                                                    <h6>Customer Info</h6>
                                                    <p><strong>Name:</strong> {{ $quote->customer->first_name ?? 'N/A' }}
                                                        {{ $quote->customer->last_name ?? '' }}
                                                    </p>
                                                    <p><strong>Contact:</strong> {{ $quote->customer->mobile ?? 'N/A' }}</p>
                                                    <p><strong>Email:</strong> {{ $quote->customer->email ?? 'N/A' }}</p>
                                                    <p><strong>Expected Delivery:</strong>
                                                        {{ \Carbon\Carbon::parse($quote->delivery_date)->format('d F Y') ?? 'N/A' }}
                                                    </p>
                                                    <p><strong>Delivery Address:</strong>
                                                        {{ $quote->deliveryAddress->address ?? '' }}</p>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h6>Company Info</h6>
                                                    <p><strong>Name:</strong> My Company Name</p>
                                                    <p><strong>Contact:</strong> 0-00-000-000</p>
                                                    <p><strong>Email:</strong> yourcompany@gmail.com</p>
                                                    <p><strong>Website:</strong> www.company.com</p>
                                                </div>
                                            </div>

                                            <!-- Quote Items -->
                                            <h6 class="mb-2">Quote Items</h6>
                                            <ul class="list-group mb-3">
                                                @forelse($quote->items as $item)
                                                    <li class="list-group-item">
                                                        {{-- Subcategory and Category --}}
                                                        <div style="font-weight: 600;">
                                                            {{ $item->subcategory->name ?? 'N/A' }}
                                                            ({{ optional($item->subcategory->categories->first())->name ?? 'N/A' }})
                                                        </div>

                                                        {{-- Attributes --}}
                                                        @if($item->attributes && $item->attributes->count())
                                                            @foreach($item->attributes as $attr)
                                                                <div style="font-size: 14px; margin-left: 10px;">
                                                                    <strong>{{ $attr->attribute->name ?? 'Attribute' }}:</strong>
                                                                    @if($attr->attributeValue)
                                                                        {{ $attr->attributeValue->value }}
                                                                    @elseif($attr->length && $attr->width)
                                                                        {{ $attr->length }} x {{ $attr->width }} {{ $attr->unit }}
                                                                    @elseif($attr->length)
                                                                        {{ $attr->length }} {{ $attr->unit }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                          
                                                        @else
                                                            <div class="text-muted" style="font-size: 13px; margin-left: 10px;">
                                                                No attributes selected.
                                                            </div>
                                                        @endif

                                                        {{-- Pages --}}
                                                        @if (!is_null($item->pages))
                                                            <div style="font-size: 14px; margin-left: 10px;">
                                                                <strong>Pages:</strong> {{ $item->pages }}
                                                            </div>
                                                        @endif

                                                        {{-- Quantity & Price --}}
                                                        <div class="mt-1" style="font-size: 14px;">
                                                            <strong>Quantity:</strong> {{ $item->quantity }} |
                                                            <strong>Price:</strong> £{{ number_format($item->sub_total, 2) }}
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="list-group-item text-center text-muted">No quote items found.
                                                    </li>
                                                @endforelse

                                                {{-- Proofreading row --}}
                                                @if($quote->proof_type && $quote->proof_price)
                                                    <li class="list-group-item">
                                                        <strong>Proof Type:</strong> {{ ucfirst($quote->proof_type) }} |
                                                        <strong>Price:</strong> £{{ number_format($quote->proof_price, 2) }}
                                                    </li>
                                                @endif
                                            </ul>

                                            <!-- Summary -->
                                            <div class="row justify-content-end mb-4">
                                                <div class="col-md-5">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Subtotal:</th>
                                                            <td class="text-end">
                                                                £{{ number_format($quote->items->sum('sub_total') + ($quote->proof_price ?? 0), 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Delivery Charge:</th>
                                                            <td class="text-end">
                                                                £{{ number_format($quote->delivery_price, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>VAT ({{ (int) $quote->vat_percentage }}%):</th>
                                                            <td class="text-end">£{{ number_format($quote->vat_amount, 0) }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-top">
                                                            <th>Grand Total:</th>
                                                            <td class="text-end">
                                                                <strong>£{{ number_format($quote->grand_total, 2) }}</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Horizontal Line -->
                                            <hr />



                                            <!-- Buttons -->
                                            <div class="row justify-content-center mt-4">
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary w-100">Download PDF</button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-success w-100">Send Email</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>

@endsection
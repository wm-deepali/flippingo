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
                            <small class="text-muted" style="font-weight:600;">#INV-1001</small>
                        </div>
                        <div>
                            <img src="{{ asset('admin_assets/images/logo.png') }}" alt="Logo" style="height: 60px;padding:10px;background:#000;border-radius:4px;" >
                        </div>
                    </div>

                    {{-- Issued/Billed/From Info --}}
                    <div class="row border-top border-bottom mb-4" style="font-size: 14px;">
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">Info</strong>
                            <hr>
                            <p style="margin-bottom:6px;"><strong>Invoice Date:</strong> 05 Sep, 2025</p>
                            <p style="margin-bottom:6px;"><strong>Order Id:</strong> #ORD-2025</p>
                            <p style="margin-bottom:6px;"><strong>Payment Status:</strong> Paid</p>
                            <p style="margin-bottom:6px;"><strong>Payment Method:</strong> Credit Card</p>
                            <p style="margin-bottom:6px;"><strong>Payment Date:</strong> 03 Sep, 2025</p>
                        </div>
                        <div class="col-md-4 border-left border-right p-2">
                            <strong class="mb-1">Billed to</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;">John Doe</p>
                            <p style="margin-bottom:6px;">123 Street Name, London, UK</p>
                            <p style="margin-bottom:4px;">+44 123 456 789</p>
                            <p style="margin-bottom:6px; color:blue;">johndoe@email.com</p>
                        </div>
                        <div class="col-md-4 p-2">
                            <strong class="mb-1">From</strong>
                            <hr>
                            <p style="margin-bottom:6px; font-weight:600;">Nuvem Print</p>
                            <p style="margin-bottom:6px;">Unit 7 Lotherton Way Garforth Leeds LS252JY</p>
                            <p style="margin-bottom:4px;">01132 874724</p>
                            <p style="color:blue;">andy@nuvemprint.com</p>
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
                                    <th>Rate (£)</th>
                                    <th>Total (£)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;">Business Cards (Printing)</div>
                                        <div style="margin-top: 5px; font-size: 13px; margin-left: 8px;">
                                            <strong>Size:</strong> 85 x 55 mm
                                        </div>
                                        <div style="margin-top: 5px; font-size: 13px; margin-left: 8px;">
                                            <strong>Pages:</strong> 2
                                        </div>
                                    </td>
                                    <td>100</td>
                                    <td>0.50</td>
                                    <td>50.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;">Flyers (Marketing)</div>
                                        <div style="margin-top: 5px; font-size: 13px; margin-left: 8px;">
                                            <strong>Size:</strong> A4
                                        </div>
                                        <div style="margin-top: 5px; font-size: 13px; margin-left: 8px;">
                                            <strong>Pages:</strong> 1
                                        </div>
                                    </td>
                                    <td>500</td>
                                    <td>0.10</td>
                                    <td>50.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Totals --}}
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">£100.00</td>
                                </tr>
                                <tr>
                                    <th>Delivery Charge:</th>
                                    <td class="text-right">£10.00</td>
                                </tr>
                                <tr>
                                    <th>Proof Reading:</th>
                                    <td class="text-right">£5.00</td>
                                </tr>
                                <tr>
                                    <th>VAT (20%):</th>
                                    <td class="text-right">£23.00</td>
                                </tr>
                                <tr class="font-weight-bold"
                                    style="font-size: 18px; color: #6B3DF4; border-top:2px solid #6B3DF4; border-bottom:2px solid #6B3DF4;">
                                    <th><strong>Total</strong></th>
                                    <td class="text-right"><strong>£138.00</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-3">
                            <a href="#" class="btn btn-outline-primary btn-block">
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

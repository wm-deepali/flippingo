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
                                <li class="breadcrumb-item active">Seller Payouts</li>
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
                            <h4>Seller Payouts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Seller</th>
                                            <th>Amount (₹)</th>
                                            <th>Status</th>
                                            <th>Payment Method</th>
                                            <th>Requested At</th>
                                            <th>Processed At</th>
                                            <th>Processed By</th>
                                            <th>Payment Date</th>
                                            <th>Reference ID</th>
                                            <th>Remarks</th>
                                            <th>Screenshot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests as $req)
                                        <tr>
                                            <td>{{ $req->id }}</td>

                                            <td>
                                                {{ $req->customer->customer_id ?? '-' }}<br>
                                                {{ $req->customer->first_name ?? '' }} {{ $req->customer->last_name ?? '' }}<br>
                                                {{ $req->customer->email ?? '-' }}
                                            </td>

                                            <td>₹{{ number_format($req->amount, 2) }}</td>

                                            <td>
                                                <span class="badge bg-success">{{ ucfirst($req->status) }}</span>
                                            </td>

                                            <td>
                                                @if($req->paymentMethod)
                                                    <strong>Type:</strong> {{ $req->paymentMethod->type }}<br>
                                                    @switch($req->paymentMethod->type)
                                                        @case('bank')
                                                            <strong>Account Name:</strong> {{ $req->paymentMethod->account_holder_name ?? '-' }}<br>
                                                            <strong>Account Number:</strong> {{ $req->paymentMethod->account_number ?? '-' }}<br>
                                                            <strong>Bank:</strong> {{ $req->paymentMethod->bank_name ?? '-' }}<br>
                                                            <strong>IFSC:</strong> {{ $req->paymentMethod->ifsc_code ?? '-' }}
                                                        @break
                                                        @case('upi')
                                                            <strong>Receiver Name:</strong> {{ $req->paymentMethod->receiver_name ?? '-' }}<br>
                                                            <strong>UPI ID:</strong> {{ $req->paymentMethod->upi_id ?? '-' }}
                                                        @break
                                                        @case('paypal')
                                                            <strong>PayPal Email:</strong> {{ $req->paymentMethod->paypal_email ?? '-' }}
                                                        @break
                                                        @case('wire')
                                                            <strong>Account Name:</strong> {{ $req->paymentMethod->account_holder_name ?? '-' }}<br>
                                                            <strong>Account Number:</strong> {{ $req->paymentMethod->account_number ?? '-' }}<br>
                                                            <strong>Bank:</strong> {{ $req->paymentMethod->bank_name ?? '-' }}<br>
                                                            <strong>Bank Address:</strong> {{ $req->paymentMethod->bank_address ?? '-' }}<br>
                                                            <strong>Bank Swift Code:</strong> {{ $req->paymentMethod->swift_code ?? '-' }}<br>
                                                            <strong>IBAN Number:</strong> {{ $req->paymentMethod->iban_number ?? '-' }}
                                                        @break
                                                        @default
                                                            Details not available
                                                    @endswitch
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>{{ $req->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $req->processed_at ? $req->processed_at->format('Y-m-d H:i') : '-' }}</td>
                                            <td>{{ $req->processedBy ? $req->processedBy->name : '-' }}</td>
                                            <td>{{ $req->payment_date ? $req->payment_date->format('Y-m-d') : '-' }}</td>
                                            <td>{{ $req->reference_id ?? '-' }}</td>
                                            <td>{{ $req->remarks ?? '-' }}</td>
                                            <td>
                                                @if($req->screenshot)
                                                    <a href="{{ asset('storage/' . $req->screenshot) }}" target="_blank">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $requests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

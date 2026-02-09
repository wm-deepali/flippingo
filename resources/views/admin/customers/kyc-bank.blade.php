@extends('layouts.master')

@section('title', 'KYC & Bank Verification')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            {{-- Breadcrumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.customers.index') }}">Customers</a>
                        </li>
                        <li class="breadcrumb-item active">KYC & Bank Details</li>
                    </ol>
                </div>
            </div>

            <div class="content-body">
                <div class="row">

                    {{-- ================= CUSTOMER BASIC INFO ================= --}}
                    <div class="col-md-12">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="card-title">Customer Information</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                <p><strong>Email:</strong> {{ $customer->email }}</p>
                                <p><strong>Mobile:</strong> {{ $customer->mobile ?? '-' }}</p>
                                <p><strong>Country:</strong> {{ $customer->countryname->name ?? '-' }}</p>

                                <p>
                                    <strong>Status:</strong>
                                    @if($customer->is_verified)
                                        <span class="badge badge-success">Verified</span>
                                    @else
                                        <span class="badge badge-warning">Pending Verification</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- ================= KYC DETAILS ================= --}}
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="card-title">KYC Details</h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Legal / Entity Name</th>
                                        <td>{{ $customer->legal_name ?? '-' }}</td>
                                    </tr>

                                    @php
                                        $isIndian = strtolower(optional($customer->countryname)->name ?? '') === 'india';
                                        $kyc = $customer->kyc;
                                    @endphp

                                    @if($isIndian)
                                        <tr>
                                            <th>PAN Number</th>
                                            <td>{{ $kyc->pan_number ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>PAN Document</th>
                                            <td>
                                                @if($kyc?->pan_document)
                                                    <a href="{{ asset('storage/' . $kyc->pan_document) }}" target="_blank">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Aadhaar Number</th>
                                            <td>{{ $kyc->aadhaar_number ?? '-' }}</td>
                                        </tr>

                                        <tr>
                                            <th>Aadhaar Front</th>
                                            <td>
                                                @if($kyc?->aadhaar_front)
                                                    <a href="{{ asset('storage/' . $kyc->aadhaar_front) }}" target="_blank">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Aadhaar Back</th>
                                            <td>
                                                @if($kyc?->aadhaar_back)
                                                    <a href="{{ asset('storage/' . $kyc->aadhaar_back) }}" target="_blank">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>GST Number</th>
                                            <td>{{ $kyc->gst_number ?? '-' }}</td>
                                        </tr>

                                        <tr>
                                            <th>GST Certificate</th>
                                            <td>
                                                @if($kyc?->gst_document)
                                                    <a href="{{ asset('storage/' . $kyc->gst_document) }}" target="_blank">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Government ID Number</th>
                                            <td>{{ $kyc->personal_id_number ?? '-' }}</td>
                                        </tr>

                                        <tr>
                                            <th>Government ID Document</th>
                                            <td>
                                                @if($kyc?->personal_id_document)
                                                    <a href="{{ asset('storage/' . $kyc->personal_id_document) }}"
                                                        target="_blank">View</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Entity Registration No</th>
                                        <td>{{ $kyc->entity_registration_number ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Entity Registration File</th>
                                        <td>
                                            @if($kyc?->entity_registration_document)
                                                <a href="{{ asset('storage/' . $kyc->entity_registration_document) }}"
                                                    target="_blank">View</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Tax Registration No</th>
                                        <td>{{ $kyc->tax_registration_number ?? '-' }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ================= BANK & PAYMENT METHODS ================= --}}
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h4 class="card-title">Bank & Payment Methods</h4>
                            </div>
                            <div class="card-body">

                                @forelse($customer->paymentMethods as $method)
                                    <div class="border p-1 mb-1">
                                        <strong>{{ strtoupper($method->type) }}</strong><br>

                                        @if($method->type === 'bank')
                                            Holder: {{ $method->account_holder_name }}<br>
                                            Account No: {{ $method->account_number }}<br>
                                            IFSC: {{ $method->ifsc_code }}<br>
                                            Bank: {{ $method->bank_name }}
                                        @endif

                                        @if($method->type === 'upi')
                                            Receiver: {{ $method->receiver_name }}<br>
                                            UPI ID: {{ $method->upi_id }}
                                        @endif

                                        @if($method->type === 'paypal')
                                            Receiver: {{ $method->receiver_name }}<br>
                                            Email: {{ $method->paypal_email }}
                                        @endif

                                        @if($method->type === 'wire')
                                            Account Owner: {{ $method->account_owner }}<br>
                                            Bank: {{ $method->bank_name }}<br>
                                            SWIFT: {{ $method->swift_code }}
                                        @endif
                                    </div>
                                @empty
                                    <p>No payment methods added.</p>
                                @endforelse

                            </div>
                        </div>
                    </div>

                    {{-- ================= VERIFY / REJECT ================= --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                @if($customer->is_verified)

                                    {{-- ALREADY VERIFIED --}}
                                    <div class="alert alert-success">
                                        <strong>✔ User is Verified</strong><br>

                                        @if($customer->verified_at)
                                            <small>
                                                Verified on:
                                                {{ $customer->verified_at->format('d M Y, h:i A') }}
                                            </small><br>
                                        @endif

                                        @if($customer->verification_note)
                                            <small>
                                                Note: {{ $customer->verification_note }}
                                            </small>
                                        @endif
                                    </div>

                                    <form method="POST" action="{{ route('admin.customers.verify', $customer->id) }}">
                                        @csrf

                                        <input type="hidden" name="action" value="reject">

                                        <div class="form-group">
                                            <label>Unverify Note (optional)</label>
                                            <textarea name="verification_note" class="form-control"
                                                placeholder="Reason for unverifying this user"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-danger">
                                            Unverify User
                                        </button>

                                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                                            Back
                                        </a>
                                    </form>

                                @else

                                    {{-- NOT VERIFIED --}}
                                    <form method="POST" action="{{ route('admin.customers.verify', $customer->id) }}">
                                        @csrf

                                        <div class="form-group">
                                            <label>Verification Note (optional)</label>
                                            <textarea name="verification_note" class="form-control"
                                                placeholder="Reason for approval / rejection"></textarea>
                                        </div>

                                        <button name="action" value="approve" class="btn btn-success">
                                            Verify User
                                        </button>

                                        <button name="action" value="reject" class="btn btn-danger">
                                            Reject Verification
                                        </button>

                                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                                            Back
                                        </a>
                                    </form>

                                @endif

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
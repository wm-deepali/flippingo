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

                            @php
                                $isIndian = strtolower(optional($customer->countryname)->name ?? '') === 'india';
                                $kyc = $customer->kyc;
                            @endphp

                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Legal / Entity Name</th>
                                    <td>{{ $customer->legal_name ?? '-' }}</td>
                                </tr>

                                @if($isIndian)
                                    <tr><th>PAN Number</th><td>{{ $kyc->pan_number ?? '-' }}</td></tr>
                                    <tr><th>Aadhaar Number</th><td>{{ $kyc->aadhaar_number ?? '-' }}</td></tr>
                                    <tr><th>GST Number</th><td>{{ $kyc->gst_number ?? '-' }}</td></tr>
                                @else
                                    <tr><th>Government ID</th><td>{{ $kyc->personal_id_number ?? '-' }}</td></tr>
                                @endif

                                <tr><th>Entity Reg. No</th><td>{{ $kyc->entity_registration_number ?? '-' }}</td></tr>
                                <tr><th>Tax Reg. No</th><td>{{ $kyc->tax_registration_number ?? '-' }}</td></tr>
                            </table>

                        </div>
                    </div>
                </div>

                {{-- ================= BANK & PAYMENT ================= --}}
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
                                        Account: {{ $method->account_number }}<br>
                                        IFSC: {{ $method->ifsc_code }}
                                    @endif

                                    @if($method->type === 'upi')
                                        UPI ID: {{ $method->upi_id }}
                                    @endif
                                </div>
                            @empty
                                <p>No payment methods added.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

              {{-- ================= VERIFY / NOTE ================= --}}
<div class="col-md-12">
    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.customers.verify', $customer->id) }}">
                @csrf

                {{-- NOTE --}}
                <div class="form-group">
                    <label>Verification Note</label>
                    <textarea name="verification_note"
                              class="form-control"
                              placeholder="Add or update verification note">{{ $customer->verification_note }}</textarea>
                </div>

                {{-- SWITCH --}}
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox"
                               class="custom-control-input"
                               id="changeStatusSwitch"
                               name="change_status"
                               value="1"
                               {{ $customer->is_verified ? 'checked' : '' }}>

                        <label class="custom-control-label" for="changeStatusSwitch">
                            Verify this user
                        </label>
                    </div>

                    <small class="text-muted">
                        Turn ON to verify the user. Turn OFF to mark as unverified.
                    </small>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>

                <a href="{{ route('admin.customers.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>
</div>


            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('changeStatusSwitch');
    const buttons = document.querySelectorAll('.verify-btn');

    function updateButtons() {
        buttons.forEach(btn => btn.disabled = !toggle.checked);
    }

    toggle.addEventListener('change', updateButtons);
    updateButtons();
});
</script>
@endpush

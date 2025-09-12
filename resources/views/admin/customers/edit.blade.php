@extends('layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
                                <li class="breadcrumb-item active">Edit Customer</li>
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
                        <div class="card-body">
                            <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <div class="col-md-6 mb-2">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                               value="{{ old('first_name', $customer->first_name) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                               value="{{ old('last_name', $customer->last_name) }}">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Display Name</label>
                                        <input type="text" name="display_name" class="form-control"
                                               value="{{ old('display_name', $customer->display_name) }}">
                                    </div>

                                     <div class="col-md-6 mb-2">
                                        <label>Account Type</label>
                                        <select name="account_type" class="form-control">
                                            <option value="individual" {{ $customer->account_type == 'individual' ? 'selected' : '' }}>Individual</option>
                                            <option value="entity" {{ $customer->account_type == 'entity' ? 'selected' : '' }}>Entity</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 mb-2">
                                        <label>Legal Name</label>
                                        <input type="text" name="legal_name" class="form-control"
                                               value="{{ old('legal_name', $customer->legal_name) }}">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email', $customer->email) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Business Email</label>
                                        <input type="email" name="business_email" class="form-control"
                                               value="{{ old('business_email', $customer->business_email) }}">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" class="form-control"
                                               value="{{ old('mobile', $customer->mobile) }}">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>WhatsApp Number</label>
                                        <input type="text" name="whatsapp_number" class="form-control"
                                               value="{{ old('whatsapp_number', $customer->whatsapp_number) }}">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Full Address</label>
                                        <input type="text" name="full_address" class="form-control"
                                               value="{{ old('full_address', $customer->full_address) }}">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label>Country</label>
                                        <input type="text" name="country" class="form-control"
                                               value="{{ old('country', $customer->country) }}">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label>State</label>
                                        <input type="text" name="state" class="form-control"
                                               value="{{ old('state', $customer->state) }}">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control"
                                               value="{{ old('city', $customer->city) }}">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label>ZIP Code</label>
                                        <input type="text" name="zip_code" class="form-control"
                                               value="{{ old('zip_code', $customer->zip_code) }}">
                                    </div>

                                   

                                    <div class="col-md-6 mb-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="suspended" {{ $customer->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label>Commission Rate (%)</label>
                                        <input type="number" name="commission_rate" step="0.01" class="form-control"
                                               value="{{ old('commission_rate', $customer->commission_rate ?? setting('default_commission', 0)) }}">
                                    </div>

                                  

                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Customer</button>
                                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

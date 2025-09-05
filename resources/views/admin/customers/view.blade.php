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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a>
                                    </li>
                                    <li class="breadcrumb-item active">View Customer</li>
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
                                <h4 class="card-title">Customer Details</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $customer->first_name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $customer->last_name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Display Name</th>
                                        <td>{{ $customer->display_name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Type</th>
                                        <td>{{ $customer->account_type ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Legal Name</th>
                                        <td>{{ $customer->legal_name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $customer->email ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Business Email</th>
                                        <td>{{ $customer->business_email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>{{ $customer->mobile ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>WhatsApp Number</th>
                                        <td>{{ $customer->whatsapp_number ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email Verified At</th>
                                        <td>{{ $customer->email_verified_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Verified At</th>
                                        <td>{{ $customer->mobile_verified_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $customer->country ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{ $customer->state ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $customer->city ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Zip Code</th>
                                        <td>{{ $customer->zip_code ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Full Address</th>
                                        <td>{{ $customer->full_address ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Profile Pic</th>
                                        <td>
                                            @if($customer->profile_pic)
                                                <img src="{{ asset('storage/' . $customer->profile_pic) }}" width="100"
                                                    alt="Profile Pic">
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Verified Listings Count</th>
                                        <td>{{ $customer->listing_count }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ ucfirst($customer->status ?? 'active') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $customer->updated_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                </table>

                                <div class="mt-3">
                                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to
                                        List</a>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>

   
@endsection
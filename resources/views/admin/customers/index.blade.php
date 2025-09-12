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
                                    <li class="breadcrumb-item active">Customers</li>
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
                                <h4 class="card-title">Customer List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="customer-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Customer / Seller Info</th>
                                                <th>Wallet Balance</th>
                                                <th>Account Type</th>
                                                <th>Active Subscription</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customers as $customer)
                                                <tr>
                                                    <!-- Date & Time -->
                                                    <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>

                                                    <!-- Customer / Seller Info -->
                                                    <td>
                                                        <small>{{ $customer->customer_id }}</small><br>
                                                        <small>{{ $customer->display_name ?? $customer->first_name . ' ' . $customer->last_name }}</small><br>
                                                        <small>{{ $customer->email }}</small><br>
                                                        <small>{{ $customer->mobile ?? '-' }}</small>
                                                    </td>

                                                    <!-- Wallet Balance -->
                                                    <td>
                                                        ₹{{ number_format($customer->wallet->balance ?? 0, 2) }}
                                                    </td>

                                                    <!-- Account Type -->
                                                    <td>
                                                        {{ ucfirst($customer->account_type ?? 'customer') }}
                                                    </td>

                                                    <!-- Active Subscription -->
                                                    <td>
                                                        @if($customer->activeSubscription)
                                                            <span class="badge badge-success">
                                                                {{ $customer->activeSubscription->package->name ?? '' }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary">No Active</span>
                                                        @endif
                                                    </td>

                                                    <!-- Status -->
                                                    <td>
                                                        <span
                                                            class="badge {{ $customer->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                                            {{ ucfirst($customer->status ?? 'inactive') }}
                                                        </span>
                                                    </td>

                                                    <!-- Actions -->
                                                    <td>
                                                        <a href="{{ route('admin.customers.show', $customer->id) }}"
                                                            class="btn btn-sm btn-info">View</a>
                                                        <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <button class="btn btn-sm btn-danger delete-customer"
                                                            data-id="{{ $customer->id }}">Delete</button>

                                                        <a href="#" class="btn btn-sm btn-primary">Wallet</a>
                                                        <a href="{{ route('admin.seller-orders', $customer->id) }}"
                                                            class="btn btn-sm btn-info">
                                                            View Orders
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-success">Subscriptions</a>
                                                        <a href="#" class="btn btn-sm btn-secondary">Enquiries</a>
                                                        <a href="#" class="btn btn-sm btn-info">Chats</a>
                                                        <a href="#" class="btn btn-sm btn-danger">Tickets</a>
                                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                            data-target="#changePasswordModal{{ $customer->id }}">
                                                            Change Password
                                                        </button>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No customers found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="changePasswordModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.customers.updatePassword', $customer->id) }}" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Change Password for {{ $customer->display_name ?? $customer->first_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    {{-- Delete Script --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-customer', function () {
                const customerId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This customer will be permanently deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/customers/${customerId}`,
                            type: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            success: function (response) {
                                Swal.fire('Deleted!', response.message, 'success').then(() => location.reload());
                            },
                            error: function () {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>

@endpush
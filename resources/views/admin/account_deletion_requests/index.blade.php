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
                                    <li class="breadcrumb-item active">Account Deletion Requests</li>
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
                                <h4 class="card-title">Account Deletion Requests</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="deletion-request-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Customer Detail</th>
                                                <th>Reason for Deletion</th>
                                                <th>Deletion Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($requests as $request)
                                                <tr>
                                                    <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>
                                                        {{ $request->customer->first_name ?? '-' }}
                                                        {{ $request->customer->last_name ?? '-' }} <br>
                                                        {{ $request->customer->email ?? '-' }} <br>
                                                        {{ $request->customer->mobile ?? '-' }}
                                                    </td>
                                                    <td>{{ $request->reason ?? '-' }}</td>
                                                    <td>{{ $request->created_at ? $request->created_at->format('Y-m-d') : '-' }}
                                                    </td>
                                                    <td>{{ ucfirst($request->status) }}</td>
                                                    <td>
                                                        @if($request->status !== 'deleted')
                                                            <button class="btn btn-danger btn-sm delete-instant"
                                                                data-id="{{ $request->id }}">
                                                                Delete Instant
                                                            </button>
                                                        @endif
                                                        <a href="{{ route('admin.customers.view', $request->customer_id) }}"
                                                            class="btn btn-info btn-sm"
                                                            data-id="{{ $request->customer_id }}">
                                                            View Customer Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No requests found.</td>
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

    <div class="modal fade" id="reason-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function () {

            // Delete instant
            $(document).on('click', '.delete-instant', function () {
                const requestId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This customer account will be deleted instantly!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/account_deletion_requests/${requestId}/delete-instant`,
                            type: 'POST',
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

@endsection
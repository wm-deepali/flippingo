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
                                    <li class="breadcrumb-item active">Manage Packages</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="{{ route('admin.packages.create') }}"
                           class="btn-icon btn btn-primary btn-round btn-sm">
                            Add New Package
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Package Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="package-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Package Name</th>
                                                <th>MRP</th>
                                                <th>Discount (%)</th>
                                                <th>Offered Price</th>
                                                <th>Total Sales</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($packages as $package)
                                                <tr>
                                                    <td>{{ $package->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>{{ $package->name }}</td>
                                                    <td>{{ $package->mrp }}</td>
                                                    <td>{{ $package->discount ?? 0 }}</td>
                                                    <td>{{ $package->offered_price }}</td>
                                                    <td>{{ $package->total_sales ?? 0 }}</td>
                                                    <td>
                                                        @if($package->status === 'active')
                                                            <span class="badge badge-success">Active</span>
                                                        @elseif($package->status === 'inactive')
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @else
                                                            <span class="badge badge-secondary">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                                           class="btn btn-sm btn-info mr-1">Edit</a>
                                                        <button class="btn btn-danger btn-sm delete-btn"
                                                                data-id="{{ $package->id }}">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No packages found.</td>
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

    {{-- JS Section --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-btn', function () {
            const packageId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This package will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/packages') }}/" + packageId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire('Deleted!', response.message ?? 'Package deleted successfully.', 'success');
                            setTimeout(() => location.reload(), 1000);
                        },
                        error: function () {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    </script>

@endsection

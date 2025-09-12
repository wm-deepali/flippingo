@extends('layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <h4>Admin Commission Income from Sellers</h4>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" id="admin-commission-table">
                                <thead>
                                    <tr>
                                        <th>Seller ID</th>
                                        <th>Seller Name</th>
                                        <th>Email</th>
                                        <th>Wallet Balance (₹)</th>
                                        <th>Account Type</th>
                                        <th>Total Orders</th>
                                        <th>Admin Commission (₹)</th>
                                        <th>Last Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        @php
                                            $lastOrder = $item['orders']->sortByDesc('created_at')->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $item['seller']->customer_id }}</td>
                                            <td>{{ $item['seller']->display_name ?? $item['seller']->first_name . ' ' . $item['seller']->last_name }}</td>
                                            <td>{{ $item['seller']->email }}</td>
                                            <td>₹{{ number_format($item['seller']->wallet->balance ?? 0, 2) }}</td>
                                            <td>{{ ucfirst($item['seller']->account_type ?? 'seller') }}</td>
                                            <td>{{ $item['orders']->count() }}</td>
                                            <td>₹{{ number_format($item['total_admin_income'], 2) }}</td>
                                            <td>{{ $lastOrder ? $lastOrder->created_at->format('Y-m-d H:i') : '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.seller-orders', $item['seller']->id) }}" class="btn btn-sm btn-info">
                                                    View Orders
                                                </a>
                                                <a href="{{ route('admin.customers.show', $item['seller']->id) }}" class="btn btn-sm btn-primary">
                                                    View Seller Info
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No sellers with submissions found.</td>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#admin-commission-table').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 25
        });
    });
</script>
@endpush

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
                                <li class="breadcrumb-item active">Manage Orders</li>
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
                            <h4 class="card-title">Orders Listing</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="orders-table">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Order ID</th>
                                            <th>Seller Info</th>
                                            <th>Transaction ID</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Subscription Status</th>
                                            <th>Subscription Expiry</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-05 10:30</td>
                                            <td>#ORD1001</td>
                                            <td>
                                                Seller ID: S101<br>
                                                John Doe<br>
                                                john@example.com
                                            </td>
                                            <td>TXN789654</td>
                                            <td>Credit Card</td>
                                            <td><span class="badge badge-success">Paid</span></td>
                                            <td><span class="badge badge-primary">Active</span></td>
                                            <td>2026-09-05</td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary">View Order Detail</button>
                                                <button class="btn btn-sm btn-info">View Seller Detail</button>
                                                <button class="btn btn-sm btn-primary">Download Invoice</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-04 15:45</td>
                                            <td>#ORD1002</td>
                                            <td>
                                                Seller ID: S102<br>
                                                Jane Smith<br>
                                                jane@example.com
                                            </td>
                                            <td>TXN456123</td>
                                            <td>PayPal</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td><span class="badge badge-danger">Inactive</span></td>
                                            <td>2025-12-15</td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary">View Order Detail</button>
                                                <button class="btn btn-sm btn-info">View Seller Detail</button>
                                                <button class="btn btn-sm btn-primary">Download Invoice</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-01 09:20</td>
                                            <td>#ORD1003</td>
                                            <td>
                                                Seller ID: S103<br>
                                                Michael Lee<br>
                                                michael@example.com
                                            </td>
                                            <td>TXN987321</td>
                                            <td>Bank Transfer</td>
                                            <td><span class="badge badge-success">Paid</span></td>
                                            <td><span class="badge badge-primary">Active</span></td>
                                            <td>2026-01-01</td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary">View Order Detail</button>
                                                <button class="btn btn-sm btn-info">View Seller Detail</button>
                                                <button class="btn btn-sm btn-primary">Download Invoice</button>
                                            </td>
                                        </tr>
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

@endsection

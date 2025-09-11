@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Reports' }}
@endsection


<style>
    .raise-ticket {
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    /* Top Cards */
    .ticket-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .ticket-card {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        color: #333;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ticket-card .ticket-left span {
        font-size: 18px;
        color: #666;
    }

    .ticket-card .ticket-left h3 {
        margin: 0;
        font-size: 28px !important;
        font-weight: 600 !important;
    }

    .ticket-card .ticket-icon {
        font-size: 28px;
    }

    /* pastel background */
    .ticket-card.new {
        background: #e0f7fa;
    }

    .ticket-card.progress {
        background: #fff3e0;
    }

    .ticket-card.resolved {
        background: #e8f5e9;
    }

    /* Header */
    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .ticket-header h2 {
        margin: 0;
    }

    .ticket-header p {
        flex: 1;
        /* margin: 0 15px;  */
        color: #555;
    }

    .btn-create {
        background: #059669;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-create:hover {
        background: #047857;
    }

    /* Table */
    .ticket-table {
        width: 100%;
        border-collapse: collapse;
    }

    .ticket-table th,
    .ticket-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        vertical-align: top;
    }

    .ticket-table th {
        background: #f9fafb;
    }

    .status {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
    }

    .status.in-progress {
        background: #fef3c7;
        color: #92400e;
    }

    .status.resolved {
        background: #d1fae5;
        color: #065f46;
    }

    .btn-view,
    .btn-reply {
        padding: 6px 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin: 2px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        background: #3b82f6;
        color: #fff;
    }

    .btn-reply {
        background: #10b981;
        color: #fff;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
    }

    .modal-box form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .modal-box input,
    .modal-box textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .modal-actions {
        text-align: right;
        margin-top: 10px;
    }

    .btn-close {
        background: #f87171;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
    }

    .btn-submit {
        background: #059669;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
    }
</style>

@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">

        <div class="report-analystics container my-4">

            <!-- Title -->
            <h4 class="mb-4 fw-bold">Reports & Analytics</h4>

            <!-- Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="report-card pastel-blue">
                        <p>Total Clicks</p>
                        <h3>12,450</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report-card pastel-green">
                        <p>Total Views</p>
                        <h3>48,320</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report-card pastel-yellow">
                        <p>Estimated Traffic (Per Day)</p>
                        <h3>3,240</h3>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3 report-tabs" id="analyticsTabs">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#today">Today</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#days7">7 Days</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#days15">15 Days</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#days30">30 Days</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#allTime">All Time</a></li>
            </ul>

            <!-- Filters -->
            <div class="row mb-3 g-3">
                <div class="col-md-3">
                    <select class="form-select">
                        <option>Filter by Category</option>
                        <option>Electronics</option>
                        <option>Clothing</option>
                        <option>Home Appliances</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>Sort By</option>
                        <option>Maximum Views</option>
                        <option>Maximum Clicks</option>
                        <option>Recent First</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive bg-white p-3 rounded shadow-sm">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date & Time</th>
                            <th>Product Detail</th>
                            <th>Category</th>
                            <th style="white-space: nowrap;">Published Date</th>
                            <th style="white-space: nowrap;">Total Clicks</th>
                            <th style="white-space: nowrap;">Total Views</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>08-09-2025 | 10:30 AM</td>
                            <td>Smartphone XYZ</td>
                            <td>Electronics</td>
                            <td>01-09-2025</td>
                            <td>560</td>
                            <td>1240</td>
                            <td><span class="badge bg-success" style="color: #fff;">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye" style="color: #fff;"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>07-09-2025 | 04:20 PM</td>
                            <td>Running Shoes</td>
                            <td>Clothing</td>
                            <td>28-08-2025</td>
                            <td>340</td>
                            <td>980</td>
                            <td><span class="badge bg-warning" style="color: #fff;">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye" style="color: #fff;"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- CSS -->
    </div>

@endsection

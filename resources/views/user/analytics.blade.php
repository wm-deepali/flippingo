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
                <div class="col-md-3">
                    <div class="report-card pastel-blue">
                        <p>Total Clicks</p>
                        <h3>{{ number_format($totalClicks) }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="report-card pastel-green">
                        <p>Total Views</p>
                        <h3>{{ number_format($totalViews) }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="report-card pastel-purple">
                        <p>Unique Views</p>
                        <h3>{{ number_format($uniqueViews) }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="report-card pastel-yellow">
                        <p>Estimated Traffic (Per Day)</p>
                        <h3>{{ number_format($estimatedTraffic) }}</h3>
                    </div>
                </div>
            </div>


            <!-- Tabs -->
<ul class="nav nav-tabs mb-3 report-tabs" id="analyticsTabs">
    @php
        $queryParams = ['category' => $categoryFilter, 'start_date' => $startDate, 'end_date' => $endDate, 'sort' => $sort];
    @endphp
    <li class="nav-item"><a href="{{ route('dashboard.analytics', array_merge($queryParams, ['filter' => 'all'])) }}" class="nav-link @if($filter == 'all') active @endif">Recent</a></li>
    <li class="nav-item"><a href="{{ route('dashboard.analytics', array_merge($queryParams, ['filter' => 'today'])) }}" class="nav-link @if($filter == 'today') active @endif">Today</a></li>
    <li class="nav-item"><a href="{{ route('dashboard.analytics', array_merge($queryParams, ['filter' => 'days7'])) }}" class="nav-link @if($filter == 'days7') active @endif">7 Days</a></li>
    <li class="nav-item"><a href="{{ route('dashboard.analytics', array_merge($queryParams, ['filter' => 'days15'])) }}" class="nav-link @if($filter == 'days15') active @endif">15 Days</a></li>
    <li class="nav-item"><a href="{{ route('dashboard.analytics', array_merge($queryParams, ['filter' => 'days30'])) }}" class="nav-link @if($filter == 'days30') active @endif">30 Days</a></li>
</ul>

            <!-- Filters -->
        <form method="GET" action="{{ route('dashboard.analytics') }}" id="filterForm">
    <div class="row mb-3 g-3">
        <div class="col-md-3">
           <select name="category" class="form-select" onchange="this.form.submit()">
    <option value="">All Categories</option>
    @foreach($categories as $category)
        <option value="{{ $category->name }}" @if($categoryFilter == $category->name) selected @endif>
            {{ $category->name }}
        </option>
    @endforeach
</select>

        </div>
        <div class="col-md-3">
            <input type="date" name="start_date" value="{{ $startDate }}" class="form-control" onchange="document.getElementById('filterForm').submit();">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" onchange="document.getElementById('filterForm').submit();">
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select" onchange="document.getElementById('filterForm').submit();">
                <option value="">Sort By</option>
                <option value="Maximum Views" @if($sort == 'Maximum Views') selected @endif>Maximum Views</option>
                <option value="Maximum Clicks" @if($sort == 'Maximum Clicks') selected @endif>Maximum Clicks</option>
                <option value="Recent First" @if($sort == 'Recent First') selected @endif>Recent First</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="filter" value="{{ $filter }}">
</form>


            <!-- Table -->
            <div class="table-responsive bg-white p-3 rounded shadow-sm">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date & Time</th>
                            <th>Product Detail</th>
                            <th style="white-space: nowrap;">Published Date</th>
                            <th style="white-space: nowrap;">Total Clicks</th>
                            <th style="white-space: nowrap;">Total Views</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->created_at->format('d-m-Y | h:i A') }}</td>
                                <td>
                                    <span class="product-name">{{ $submission->product_title }}</span><br>
                                    <small>{{ $submission->category_name }}</small><br>
                                    @if ($submission->product_photo)
                                        <img src="{{ asset('storage/' . $submission->product_photo) }}" alt="Product Photo"
                                            width="50">
                                    @endif
                                </td>
                                <td>{{ $submission->published_at ? $submission->published_at->format('d-m-Y') : '-' }}</td>
                                <td>{{ number_format($submission->total_clicks) }}</td>
                                <td>{{ number_format($submission->total_views) }}</td>

          <td>
  @switch($submission->status)
    @case('pending')
      <span class="badge badge-secondary">Recent</span>
      @break
    @case('published')
      <span class="badge badge-success">Published</span>
      @break
    @case('expired')
      <span class="badge badge-warning">Expired</span>
      @break
    @case('rejected')
      <span class="badge badge-danger">Rejected</span>
      @break
    @default
      <span class="badge badge-light">{{ ucfirst($submission->status) }}</span>
  @endswitch
</td>
                                <td>
                                    <a href="{{ route('listing-details', ['id' => $submission->id]) }}"
                                        class="btn btn-sm btn-primary" title="View">
                                        <i class="bi bi-eye" style="color: #fff;">view Listing Details</i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No submissions available.</td>
                            </tr>
                        @endforelse
                    </tbody>


                </table>
            </div>

        </div>

        <!-- CSS -->
    </div>

@endsection
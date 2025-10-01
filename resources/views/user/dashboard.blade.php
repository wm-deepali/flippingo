@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Flippingo' }}
@endsection


@section('content')
    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="second-top-header d-flex justify-content-between">
            <div class="second-top-left-text d-flex flex-column">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Manage your buyer and seller activities
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
            <div class="second-top-left d-flex " style="gap: 10px;">
                <button class="refresh-button"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                <button id='create-listing-btn'>+ Create Listing</button>
            </div>


        </div>
        <div class="dashboard-switching">
            <ul class="dashboard-tabs">
                <li class="tab-item active" data-tab="buyer">Buyer Dashboard</li>
                <li class="tab-item" data-tab="seller">Seller Dashboard</li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-pane active" id="buyer">
                <div class="seller-dashboard-cards">
                    <!-- Wallet -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Wallet Balance</h4>
                        <h2 class="seller-card-number">₹{{ $walletBalance }}</h2>
                        <p class="seller-card-desc">Available for purchases</p>
                        <a href="{{ Route('dashboard.wallet') }}" class="seller-card-footer seller-purple">
                            <span>Manage Wallet</span>
                            <i class="fas fa-wallet"></i>
                        </a>
                    </div>

                    <!-- Active Orders -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Active Orders</h4>
                        <h2 class="seller-card-number">{{  $activeOrders  }}</h2>
                        <p class="seller-card-desc">In progress</p>
                        <a href="{{ Route('dashboard.buyer-orders') }}" class="seller-card-footer seller-blue">
                            <span>View Orders</span>
                            <i class="fas fa-box"></i>
                        </a>
                    </div>

                    <!-- Purchases -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Completed Purchases</h4>
                        <h2 class="seller-card-number">{{  $completedPurchases  }}</h2>
                        <p class="seller-card-desc">Successfully acquired</p>
                        <a href="{{ Route('dashboard.buyer-orders') }}" class="seller-card-footer seller-green">
                            <span>View Purchases</span>
                            <i class="fas fa-check-circle"></i>
                        </a>
                    </div>

                    <!-- Watchlist -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Watchlist</h4>
                        <h2 class="seller-card-number">{{ $wishlistCount}}</h2>
                        <p class="seller-card-desc">Saved items</p>
                        <a href="{{ Route('dashboard.wishlist') }}" class="seller-card-footer seller-red">
                            <span>View Watchlist</span>
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
                <div class="container-fluid" style="width: 96%; margin: auto; margin-top: 20px;">
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Earning Revenues</h4>
                                  <div class="mt-4 position-relative" style="height:294px;">
    <canvas class="earningChartYear" style="width: 100%;"></canvas>
</div>
                                    <ul class="list-inline text-center mt-5 mb-2">
                                        <li class="list-inline-item text-muted font-italic">Sales for this Year</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Earning by Location</h4>
                                    <div class="" style="height:180px">
                                        <div id="visitbylocate" style="height:100%"></div>
                                    </div>
                                  @foreach($locationEarnings as $loc)
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-right">
                        <span class="text-muted font-14">{{ $loc['country'] }}</span>
                    </div>
                    <div class="col-5">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ $loc['percent'] }}%;
                                       background-color: {{ match($loop->iteration % 4) {
                                           1 => '#5f76e8', 
                                           2 => '#dc3545', 
                                           3 => '#17a2b8', 
                                           default => '#28a745'
                                       } }};"
                                aria-valuenow="{{ $loc['percent'] }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 text-right">
                        <span class="mb-0 font-14 text-dark font-weight-medium">{{ $loc['percent'] }}%</span>
                    </div>
                </div>
            @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wishlist-card">
                        @if($wishlist->count())
                    @foreach($wishlist as $item)
                        @php
                            $submission = $item->submission ?? [];
                            $customer = $submission->customer ?? [];
                        @endphp

                        <div class="wishlist-product-card">
                            @if($submission->product_photo)
                                <img src="{{ asset('storage/' . $submission->product_photo) }}" />
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                            @endif
                            <div class="wishlist-budge">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="budge-active">
                                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                    </div>
                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                                    </h4>

                                </div>

                            </div>
                            <div class="product-details-hover">
                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>

                                </div>
                                <h3 class="mt-2 " style="color: #000;">{{ $submission->product_title ?? '' }}</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By {{ ($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '') }}</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                     @if(!empty($submission->summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($submission->summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endif

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i
                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $submission->offered_price ?? '' }}</h2>
                                    <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>
                                
                                </div>
                                <h3 class="mt-2" style="color: #000;">{{$submission->product_title ?? ''}}</h3>
                             @if(!empty($submission->summaryFields))
    @php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($submission->summaryFields, function($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'textarea');
        });
    @endphp

    @if(!empty($textareaFields))
        <p style="font-size: 13px;">
            @foreach($textareaFields as $index => $field)
                @if(!empty($field['icon']))
                    <i class="{{ $field['icon'] }}" style="margin-right: 4px;"></i>
                @endif
                {{ \Illuminate\Support\Str::limit($field['value'], 100, '...') }}

                {{-- Separator except for last item --}}
                @if($index !== array_key_last($textareaFields))
                    &nbsp;|&nbsp;
                @endif
            @endforeach
        </p>
    @endif
@endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By {{ ($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '') }}</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                  @if(!empty($submission->summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($submission->summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endif
                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i
                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $submission->offered_price ?? '' }}</h2>
                                       <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $wishlist->links() }}
                    </div>
                @else
                    <p class="text-center">No items in wishlist yet.</p>
                @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Sell</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Order ID</th>
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentSales as $order)
                                                                @php $status = $order->currentStatus->status ?? 'N/A'; @endphp

                                                <tr>
                                                     <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>
                                                        <span class="product-name">{{ $order->product_title }}</span><br>
                                                        <small>{{ $order->category_name }}</small><br>
                                                        @if ($order->product_photo)
                                                            <img src="{{ asset('storage/' . $order->product_photo) }}"
                                                                alt="Product Photo" width="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->total ?? '-' }}</td>
                                                    <td>{{ $order->payment->payment_id ? 'Paid' : 'Unpaid' }}</td>
                                                    <td>
                        @switch($status)
                            @case('recent')
                                <span class="badge badge-primary">Recent</span>
                                @break
                            @case('approved')
                                <span class="badge badge-secondary">Approved</span>
                                @break
                            @case('processing')
                                <span class="badge badge-info">Processing</span>
                                @break
                            @case('delivered')
                                <span class="badge badge-success">Delivered</span>
                                @break
                            @case('cancel_requested')
                                <span class="badge badge-warning">Cancel Requested</span>
                                @break
                            @case('cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transactions</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Transaction Type</th>
                            <th>Details</th>
                            <th>Refrence Id</th>
                            <th>Amount</th>
                        </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentTransactions as $txn)
                            <tr >
                                <td>{{ $txn->created_at->format('Y-m-d') }}</td>
                                <td>{{ ucfirst($txn->type) }}</td>
                                <td>{{ ucfirst($txn->transaction_type) }}</td>
                                <td>{{ $txn->remarks ?? '-' }}</td>
                                <td>{{ $txn->reference_id }}</td>
                                <td>₹{{ number_format($txn->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="wallet-no-data">No transactions found.</td>
                            </tr>
                        @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Orders</h4>

                                    </div>
                                    <div class="table-wrapper">
                                      <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Order ID</th>
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentSales as $order)
                                                                @php $status = $order->currentStatus->status ?? 'N/A'; @endphp

                                                <tr>
                                                     <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>
                                                        <span class="product-name">{{ $order->product_title }}</span><br>
                                                        <small>{{ $order->category_name }}</small><br>
                                                        @if ($order->product_photo)
                                                            <img src="{{ asset('storage/' . $order->product_photo) }}"
                                                                alt="Product Photo" width="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->total ?? '-' }}</td>
                                                    <td>{{ $order->payment->payment_id ? 'Paid' : 'Unpaid' }}</td>
                                                    <td>
                        @switch($status)
                            @case('recent')
                                <span class="badge badge-primary">Recent</span>
                                @break
                            @case('approved')
                                <span class="badge badge-secondary">Approved</span>
                                @break
                            @case('processing')
                                <span class="badge badge-info">Processing</span>
                                @break
                            @case('delivered')
                                <span class="badge badge-success">Delivered</span>
                                @break
                            @case('cancel_requested')
                                <span class="badge badge-warning">Cancel Requested</span>
                                @break
                            @case('cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- *************************************************************** -->
                    <!-- End Sales Charts Section -->
                    <!-- *************************************************************** -->
                    <!-- *************************************************************** -->
                    <!-- Start Location and Earnings Charts Section -->
                    <!-- *************************************************************** -->
                    <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h4 class="card-title mb-0">Earning Statistics</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="#">Insert</a>
                                                    <a class="dropdown-item" href="#">Update</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <div class="pl-4 mb-5">
    <div class="position-relative" style="height: 315px;">
        <canvas class="earningChartMonth" ></canvas>
    </div>
</div>

                                    <ul class="list-inline text-center mt-4 mb-0">
                                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Activity</h4>
                                    <div class="mt-4 activity">
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                    <i data-feather="shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                                <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                                    Camera.
                                                </p>
                                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger btn-circle mb-2 btn-item">
                                                    <i data-feather="message-square"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                                <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                                    ticket</p>
                                                <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                    <i data-feather="bell"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                                </h5>
                                                <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                                <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                                    Ago</span>
                                                <a href="javascript:void(0)"
                                                    class="font-14 border-bottom pb-1 border-info">Load More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="tab-pane" id="seller">
                <div class="seller-dashboard-cards">
                    <!-- Wallet -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Wallet Balance</h4>
                        <h2 class="seller-card-number">₹{{ $walletBalance }}</h2>
                        <p class="seller-card-desc">Available for purchases</p>
                        <a href="{{ Route('dashboard.wallet') }}" class="seller-card-footer seller-purple">
                            <span>Manage Wallet</span>
                            <i class="fas fa-wallet"></i>
                        </a>
                    </div>

                    <!-- Active Orders -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Active Orders</h4>
                        <h2 class="seller-card-number">{{  $activeOrders  }}</h2>
                        <p class="seller-card-desc">In progress</p>
                        <a href="{{ Route('dashboard.buyer-orders') }}" class="seller-card-footer seller-blue">
                            <span>View Orders</span>
                            <i class="fas fa-box"></i>
                        </a>
                    </div>

                    <!-- Purchases -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Completed Purchases</h4>
                        <h2 class="seller-card-number">{{  $completedPurchases  }}</h2>
                        <p class="seller-card-desc">Successfully acquired</p>
                        <a href="{{ Route('dashboard.buyer-orders') }}" class="seller-card-footer seller-green">
                            <span>View Purchases</span>
                            <i class="fas fa-check-circle"></i>
                        </a>
                    </div>

                    <!-- Watchlist -->
                    <div class="seller-card">
                        <h4 class="seller-card-title">Watchlist</h4>
                        <h2 class="seller-card-number">{{ $wishlistCount}}</h2>
                        <p class="seller-card-desc">Saved items</p>
                        <a href="{{ Route('dashboard.wishlist') }}" class="seller-card-footer seller-red">
                            <span>View Watchlist</span>
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
                <div class="container-fluid" style="width: 96%; margin: auto; margin-top: 20px;">
                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                           <div class="card">
                                 <div class="card-body">
                                    <h4 class="card-title">Earning Revenues</h4>
                                  <div class="mt-4 position-relative" style="height:294px;">
    <canvas class="earningChartYear" style="width: 100%;"></canvas>
</div>
                                    <ul class="list-inline text-center mt-5 mb-2">
                                        <li class="list-inline-item text-muted font-italic">Sales for this Year</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Earning by Location</h4>
 <div class="" style="height:180px">
                                        <div id="visitbylocate" style="height:100%"></div>
                                    </div>
            @foreach($locationEarnings as $loc)
                <div class="row mb-3 align-items-center">
                    <div class="col-4 text-right">
                        <span class="text-muted font-14">{{ $loc['country'] }}</span>
                    </div>
                    <div class="col-5">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ $loc['percent'] }}%;
                                       background-color: {{ match($loop->iteration % 4) {
                                           1 => '#5f76e8', 
                                           2 => '#dc3545', 
                                           3 => '#17a2b8', 
                                           default => '#28a745'
                                       } }};"
                                aria-valuenow="{{ $loc['percent'] }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 text-right">
                        <span class="mb-0 font-14 text-dark font-weight-medium">{{ $loc['percent'] }}%</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

                    </div>
                    <div class="wishlist-card">
                        @if($wishlist->count())
                    @foreach($wishlist as $item)
                        @php
                            $submission = $item->submission ?? [];
                            $customer = $submission->customer ?? [];
                        @endphp

                        <div class="wishlist-product-card">
                            @if($submission->product_photo)
                                <img src="{{ asset('storage/' . $submission->product_photo) }}" />
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThez8EsMExS0cJzMTvAM6OlRj9d9SecStl6g&s">
                            @endif
                            <div class="wishlist-budge">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="budge-active">
                                        <p><i class="fa-solid fa-circle-check"></i> Active</p>
                                    </div>
                                    <h4 class="m-0" style="font-size: 24px;padding-right: 15px;"><i class="fa-regular fa-heart"></i>
                                    </h4>

                                </div>

                            </div>
                            <div class="product-details-hover">
                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>

                                </div>
                                <h3 class="mt-2 " style="color: #000;">{{ $submission->product_title ?? '' }}</h3>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By {{ ($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '') }}</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                     @if(!empty($submission->summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($submission->summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endif

                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i
                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $submission->offered_price ?? '' }}</h2>
                                    <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>

                                </div>

                            </div>
                            <div class="more-info" data-aos="fade-up" data-aos-duration="500">


                                <div class="wishlist-button">
                                    <p>{{ $submission->category_name ?? '' }}</p>
                                
                                </div>
                                <h3 class="mt-2" style="color: #000;">{{$submission->product_title ?? ''}}</h3>
                             @if(!empty($submission->summaryFields))
    @php
        // Filter textarea fields using array_filter
        $textareaFields = array_filter($submission->summaryFields, function($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'textarea');
        });
    @endphp

    @if(!empty($textareaFields))
        <p style="font-size: 13px;">
            @foreach($textareaFields as $index => $field)
                @if(!empty($field['icon']))
                    <i class="{{ $field['icon'] }}" style="margin-right: 4px;"></i>
                @endif
                {{ \Illuminate\Support\Str::limit($field['value'], 100, '...') }}

                {{-- Separator except for last item --}}
                @if($index !== array_key_last($textareaFields))
                    &nbsp;|&nbsp;
                @endif
            @endforeach
        </p>
    @endif
@endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">By {{ ($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '') }}</p>
                                    <p class="m-0" style="color: #007bff;"><i class="fa-solid fa-eye"></i> 10</p>
                                </div>
                                <div class="wishlist-item-card">
                                  @if(!empty($submission->summaryFields))
    @php
        // Use array_filter when summaryFields is a plain array
        $textFields = array_filter($submission->summaryFields, function ($field) {
            return
                isset($field['field_id']) &&
                Str::startsWith($field['field_id'], 'text_');
        });
    @endphp

    @if(!empty($textFields))
        @foreach($textFields as $field)
            <div class="wishlist-left">
                <p class="m-0" style="color: green;">
                    <i class="{{ $field['icon'] ?? '' }}"></i>
                </p>
                <div class="d-flex flex-column">
                    <p class="m-0" style="font-size: 16px;">{{ $field['label'] ?? '' }}</p>
                    <h5 class="m-0" style="color: #000; font-size: 16px;">{{ $field['value'] ?? '' }}</h5>
                </div>
            </div>
        @endforeach
    @endif
@endif
                                </div>
                                <div class="wishlist-price d-flex justify-content-between mt-3">
                                    <h2 style="color: #000;"><i
                                            class="fa-solid fa-indian-rupee-sign"></i>{{ $submission->offered_price ?? '' }}</h2>
                                       <button type="button" class="btn btn-dark"
                                                onclick="window.location.href='{{ route('listing-details', ['id' => $submission['id']]) }}'">
                                                View Detail
                                            </button>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $wishlist->links() }}
                    </div>
                @else
                    <p class="text-center">No items in wishlist yet.</p>
                @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Sell</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Order ID</th>
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentSales as $order)
                                                                @php $status = $order->currentStatus->status ?? 'N/A'; @endphp

                                                <tr>
                                                     <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>
                                                        <span class="product-name">{{ $order->product_title }}</span><br>
                                                        <small>{{ $order->category_name }}</small><br>
                                                        @if ($order->product_photo)
                                                            <img src="{{ asset('storage/' . $order->product_photo) }}"
                                                                alt="Product Photo" width="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->total ?? '-' }}</td>
                                                    <td>{{ $order->payment->payment_id ? 'Paid' : 'Unpaid' }}</td>
                                                    <td>
                        @switch($status)
                            @case('recent')
                                <span class="badge badge-primary">Recent</span>
                                @break
                            @case('approved')
                                <span class="badge badge-secondary">Approved</span>
                                @break
                            @case('processing')
                                <span class="badge badge-info">Processing</span>
                                @break
                            @case('delivered')
                                <span class="badge badge-success">Delivered</span>
                                @break
                            @case('cancel_requested')
                                <span class="badge badge-warning">Cancel Requested</span>
                                @break
                            @case('cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Recent Transactions</h4>

                                    </div>
                                    <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Transaction Type</th>
                            <th>Details</th>
                            <th>Refrence Id</th>
                            <th>Amount</th>
                        </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentTransactions as $txn)
                            <tr >
                                <td>{{ $txn->created_at->format('Y-m-d') }}</td>
                                <td>{{ ucfirst($txn->type) }}</td>
                                <td>{{ ucfirst($txn->transaction_type) }}</td>
                                <td>{{ $txn->remarks ?? '-' }}</td>
                                <td>{{ $txn->reference_id }}</td>
                                <td>₹{{ number_format($txn->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="wallet-no-data">No transactions found.</td>
                            </tr>
                        @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h4 class="card-title">Orders</h4>

                                    </div>
                                    <div class="table-wrapper">
                                      <div class="table-wrapper">

                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Order ID</th>
                                                    <th>Product Detail</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Status</th>
                                                    <th> Status</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentSales as $order)
                                                                @php $status = $order->currentStatus->status ?? 'N/A'; @endphp

                                                <tr>
                                                     <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>
                                                        <span class="product-name">{{ $order->product_title }}</span><br>
                                                        <small>{{ $order->category_name }}</small><br>
                                                        @if ($order->product_photo)
                                                            <img src="{{ asset('storage/' . $order->product_photo) }}"
                                                                alt="Product Photo" width="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->total ?? '-' }}</td>
                                                    <td>{{ $order->payment->payment_id ? 'Paid' : 'Unpaid' }}</td>
                                                    <td>
                        @switch($status)
                            @case('recent')
                                <span class="badge badge-primary">Recent</span>
                                @break
                            @case('approved')
                                <span class="badge badge-secondary">Approved</span>
                                @break
                            @case('processing')
                                <span class="badge badge-info">Processing</span>
                                @break
                            @case('delivered')
                                <span class="badge badge-success">Delivered</span>
                                @break
                            @case('cancel_requested')
                                <span class="badge badge-warning">Cancel Requested</span>
                                @break
                            @case('cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($status) }}</span>
                        @endswitch
                    </td>
                                                </tr>
                                                 @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- *************************************************************** -->
                    <!-- End Sales Charts Section -->
                    <!-- *************************************************************** -->
                    <!-- *************************************************************** -->
                    <!-- Start Location and Earnings Charts Section -->
                    <!-- *************************************************************** -->
                    <div class="row">
                        <div class="col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <h4 class="card-title mb-0">Earning Statistics</h4>
                                        <div class="ml-auto">
                                            <div class="dropdown sub-dropdown">
                                                <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                    id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                    <a class="dropdown-item" href="#">Insert</a>
                                                    <a class="dropdown-item" href="#">Update</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <div class="pl-4 mb-5">
    <div class="position-relative" style="height: 315px;">
        <canvas class="earningChartMonth"></canvas>
    </div>
</div>
                                    <ul class="list-inline text-center mt-4 mb-0">
                                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Activity</h4>
                                    <div class="mt-4 activity">
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                    <i data-feather="shopping-cart"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                                <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                                    Camera.
                                                </p>
                                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line pb-3">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger btn-circle mb-2 btn-item">
                                                    <i data-feather="message-square"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                                <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                                    ticket</p>
                                                <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start border-left-line">
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                                    <i data-feather="bell"></i>
                                                </a>
                                            </div>
                                            <div class="ml-3 mt-2">
                                                <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                                </h5>
                                                <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                                <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                                    Ago</span>
                                                <a href="javascript:void(0)"
                                                    class="font-14 border-bottom pb-1 border-info">Load More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            All Rights Reserved by Adminmart. Designed and Developed by
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            function setActiveTab(tabName) {
                // Update tab UI
                document.querySelectorAll('.dashboard-tabs .tab-item').forEach(tab => tab.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
                let selectedTab = document.querySelector('.dashboard-tabs .tab-item[data-tab="' + tabName + '"]');
                let selectedPane = document.getElementById(tabName);
                if (selectedTab && selectedPane) {
                    selectedTab.classList.add('active');
                    selectedPane.classList.add('active');
                }

                // Update sidebar visibility
                if (tabName === "buyer") {
                    document.getElementById("buyer-section").style.display = "block";
                    document.getElementById("seller-section").style.display = "none";
                } else if (tabName === "seller") {
                    document.getElementById("buyer-section").style.display = "none";
                    document.getElementById("seller-section").style.display = "block";
                }
            }

            // Get current tab from URL or localStorage or default
            let urlParams = new URLSearchParams(window.location.search);
            let currentTab = urlParams.get('tab') || localStorage.getItem("activeDashboardTab") || 'buyer';

            setActiveTab(currentTab);

            // Update URL and localStorage
            let url = new URL(window.location.href);
            url.searchParams.set('tab', currentTab);
            window.history.replaceState(null, '', url.toString());
            localStorage.setItem("activeDashboardTab", currentTab);

            // Add click listeners to tabs
            document.querySelectorAll('.dashboard-tabs .tab-item').forEach(item => {
                item.addEventListener('click', function () {
                    let selectedTab = this.getAttribute('data-tab');

                    setActiveTab(selectedTab);

                    // Update URL without reload
                    let url = new URL(window.location.href);
                    url.searchParams.set('tab', selectedTab);
                    window.history.pushState(null, '', url.toString());

                    // Save selected tab to localStorage
                    localStorage.setItem("activeDashboardTab", selectedTab);
                });
            });

            // Update tab/sidebar on browser back/forward
            window.addEventListener('popstate', () => {
                let urlParams = new URLSearchParams(window.location.search);
                let tab = urlParams.get('tab') || 'buyer';
                setActiveTab(tab);
                localStorage.setItem("activeDashboardTab", tab);
            });

            // Create listing button redirect (existing code)
            document.getElementById("create-listing-btn").addEventListener("click", function () {
                let url = "{{ route('add-listing', ['from' => 'dashboard']) }}";
                window.location.href = url;
            });

        });

    </script>
   
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // ---------------- YEARLY EARNINGS ----------------
    let yearLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    let yearData = @json(array_values($earningStatsYear->toArray()));

    let yearCharts = document.getElementsByClassName('earningChartYear');
    Array.from(yearCharts).forEach(function(chartEl) {
        new Chart(chartEl.getContext('2d'), {
            type: 'line',
            data: {
                labels: yearLabels,
                datasets: [{
                    label: 'Earnings (₹)',
                    data: yearData,
                    borderColor: '#5f76e8',
                    backgroundColor: 'rgba(95, 118, 232, 0.2)',
                    pointBackgroundColor: '#5f76e8',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: function(value){ return '₹' + value; } }
                    }
                }
            }
        });
    });

    // ---------------- THIS MONTH EARNINGS ----------------
    let weekLabels = @json(array_column($earningThisMonthWeeks, 'label'));
    let weekData = @json(array_column($earningThisMonthWeeks, 'total'));

    let monthCharts = document.getElementsByClassName('earningChartMonth');
    Array.from(monthCharts).forEach(function(chartEl) {
        new Chart(chartEl.getContext('2d'), {
            type: 'bar',
            data: {
                labels: weekLabels,
                datasets: [{
                    label: 'Earnings (₹)',
                    data: weekData,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });


});
</script>



@endpush

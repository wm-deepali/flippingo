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
                                <h4 class="card-title">Subscription Orders</h4>
                            </div>
                            <div class="card-body">

                                <!-- Tabs navigation -->
                                <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="all-tab" data-toggle="tab" data-target="#all"
                                            type="button" role="tab" aria-controls="all" aria-selected="false">All
                                            Subscriptions</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="active-tab" data-toggle="tab"
                                            data-target="#active" type="button" role="tab" aria-controls="active"
                                            aria-selected="true">Active Subscriptions</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="inactive-tab" data-toggle="tab" data-target="#inactive"
                                            type="button" role="tab" aria-controls="inactive"
                                            aria-selected="false">Cancelled Subscriptions</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="expired-tab" data-toggle="tab" data-target="#expired"
                                            type="button" role="tab" aria-controls="expired" aria-selected="false">Expired
                                            Subscriptions</button>
                                    </li>
                                </ul>

                                <!-- Tabs content -->
                                <div class="tab-content pt-2" id="orderTabsContent">
                                    <!-- All Subscriptions Tab -->
                                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                        @include('admin.subscriptions.partials.subscription-table-all', ['subscriptions' => $subscriptions])
                                    </div>

                                    <!-- Active Subscriptions Tab -->
                                    <div class="tab-pane fade" id="active" role="tabpanel"
                                        aria-labelledby="active-tab">
                                        @include('admin.subscriptions.partials.subscription-table', ['subscriptions' => $subscriptions->where('status', 'active')])
                                    </div>

                                    <!-- Cancelled Subscriptions Tab -->
                                    <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                                        @include('admin.subscriptions.partials.subscription-table-cancelled', ['subscriptions' => $subscriptions->where('status', 'cancelled')])
                                    </div>

                                    <!-- Expired Subscriptions Tab -->
                                    <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                                        @include('admin.subscriptions.partials.subscription-table-expired', ['subscriptions' => $subscriptions->where('status', 'expired')])
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@extends('layouts.master')

@section('title', 'Subscription Analytics & Reports')

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
                                    <li class="breadcrumb-item active">Manage Subscription Reports</li>
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
                                <h4 class="card-title">Subscription Reports</h4>
                            </div>
                            <div class="card-body">
 

                                 <ul class="nav nav-tabs" id="reportTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                        Active Subscriptions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="expiring-today-tab" data-toggle="tab" href="#expiring-today" role="tab" aria-controls="expiring-today" aria-selected="false">
                        Expiring Today
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="7day-tab" data-toggle="tab" href="#seven-day" role="tab" aria-controls="seven-day" aria-selected="false">
                        7 Days
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="15day-tab" data-toggle="tab" href="#fifteen-day" role="tab" aria-controls="fifteen-day" aria-selected="false">
                        15 Days
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="30day-tab" data-toggle="tab" href="#thirty-day" role="tab" aria-controls="thirty-day" aria-selected="false">
                        30 Days
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-date-tab" data-toggle="tab" href="#custom-date" role="tab" aria-controls="custom-date" aria-selected="false">
                        Custom Date
                    </a>
                </li>
            </ul>

            <div class="tab-content pt-3" id="reportTabsContent">

  @foreach (['active', 'expiring-today', 'seven-day', 'fifteen-day', 'thirty-day', 'custom-date'] as $key)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
                        @if(isset($reports[$key]) && $reports[$key]->count() > 0)
                            @include('admin.reports.sub-table', ['subscriptions' => $reports[$key]])
                        @else
                            <p class="text-center text-muted mt-4">No Subscription records in this period.</p>
                        @endif
                    </div>
                @endforeach

            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
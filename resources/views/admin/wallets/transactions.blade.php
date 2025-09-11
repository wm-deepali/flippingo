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
                                    <li class="breadcrumb-item active">Wallet Transaction </li>
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
                                <h4>Transactions for {{ $wallet->customer->first_name ?? '-' }}
                                    {{ $wallet->customer->last_name ?? '' }}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Remarks</th>
                                                <th>Reference ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $tx)
                                                <tr>
                                                    <td>{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>{{ ucfirst($tx->type) }}</td>
                                                    <td>{{ number_format($tx->amount, 2) }}</td>
                                                    <td>{{ ucfirst($tx->transaction_type) }}</td>
                                                    <td>{{ $tx->remarks ?? '-' }}</td>
                                                    <td>{{ $tx->reference_id ?? '-' }}</td>
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
        </div>
    </div>

@endsection
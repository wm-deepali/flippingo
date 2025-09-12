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
                                    <li class="breadcrumb-item active">All Wallets
                                    </li>
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
                                <h4>All Wallets
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Customer Info</th>
                                                <th>Balance</th>
                                                <th>Currency</th>
                                                <th>Total Credit (₹)</th>
                                                <th>Total Debit (₹)</th>
                                                <th>Last Transaction</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($wallets as $wallet)
                                                @php
                                                    $totalCredit = $wallet->transactions->where('type', 'credit')->sum('amount');
                                                    $totalDebit = $wallet->transactions->where('type', 'debit')->sum('amount');
                                                    $lastTransaction = $wallet->transactions->sortByDesc('created_at')->first();
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $wallet->customer->customer_id ?? '-' }}<br>
                                                        {{ $wallet->customer->first_name ?? '-' }}
                                                        {{ $wallet->customer->last_name ?? '-' }}<br>
                                                        {{ $wallet->customer->email ?? '-' }}
                                                    </td>

                                                    <td>{{ number_format($wallet->balance, 2) }}</td>
                                                    <td>{{ strtoupper($wallet->currency ?? 'USD') }}</td>
                                                    <td>₹{{ number_format($totalCredit, 2) }}</td>
                                                    <td>₹{{ number_format($totalDebit, 2) }}</td>
                                                    <td>{{ $lastTransaction ? $lastTransaction->created_at->format('Y-m-d H:i') : '-' }}
                                                    </td>
                                                    <td>{{ ucfirst($wallet->status) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.wallet.transactions', $wallet->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            View Transactions
                                                        </a>
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


        </div>
    </div>

@endsection
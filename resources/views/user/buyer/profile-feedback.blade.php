@extends('layouts.user-master')

@section('title', 'My Profile Feedback')

@section('content')

@include('user.sidebar')

<div class="page-wrapper">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="page-title">My Seller Profile Feedback</h3>
                <p class="text-muted">Feedback you submitted on seller profiles</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Seller</th>
                                <th>Rating</th>
                                <th>Feedback</th>
                                <th>Submitted On</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($feedbacks as $index => $feedback)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>
                                        <strong>
                                            {{ $feedback->seller->legal_name
                                                ?? trim($feedback->seller->first_name . ' ' . $feedback->seller->last_name) }}
                                        </strong>
                                    </td>

                                    <td style="color:#f5c518;font-size:16px;">
                                        @for($i = 1; $i <= 5; $i++)
                                            {!! $i <= $feedback->rating ? '★' : '☆' !!}
                                        @endfor
                                    </td>

                                    <td style="max-width:300px;">
                                        {{ \Illuminate\Support\Str::limit($feedback->message, 80) }}
                                    </td>

                                    <td>
                                        {{ $feedback->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        You haven’t submitted any feedback yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <footer class="footer text-center text-muted">
        All Rights Reserved.
    </footer>
</div>

@endsection

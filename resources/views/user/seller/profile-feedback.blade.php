@extends('layouts.user-master')

@section('title', 'Profile Feedback')

@section('content')
@include('user.sidebar')

<div class="page-wrapper">
    <div class="container-fluid">

        <h3 class="mb-4">Seller Profile Feedback</h3>

        <div class="card">
            <div class="card-body">

                @if($feedbacks->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedbacks as $index => $feedback)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                       <td>
                                            @if($feedback->customer)
                                                <strong>
                                                    {{ $feedback->customer->first_name ?? '' }}
                                                    {{ $feedback->customer->last_name ?? '' }}
                                                </strong>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="color:#f5c518;font-size:16px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                {!! $i <= $feedback->rating ? '★' : '☆' !!}
                                            @endfor
                                        </td>
                                        <td style="max-width:350px;">
                                            {{ Str::limit($feedback->message, 100) }}
                                        </td>
                                        <td>{{ $feedback->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No feedback received yet.</p>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection

@extends('layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        {{-- HEADER --}}
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Seller Feedback</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Seller Feedback</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Feedback ID</th>
                                    <th>Customer Info</th>
                                    <th>Seller Info</th>
                                    <th>Rating</th>
                                    <th>Message</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($feedbacks as $feedback)
                                    <tr>
                                        <td>
                                            {{ $feedback->created_at->format('d M Y, H:i') }}
                                        </td>

                                        <td>
                                            #{{ $feedback->id }}
                                        </td>

                                        {{-- Customer Info --}}
                                        <td>
                                            @if($feedback->customer)
                                                <strong>
                                                    {{ $feedback->customer->first_name ?? '' }}
                                                    {{ $feedback->customer->last_name ?? '' }}
                                                </strong><br>
                                                {{ $feedback->customer->email ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        {{-- Seller Info --}}
                                        <td>
                                            @if($feedback->seller)
                                                <strong>
                                                    {{ $feedback->seller->first_name ?? '' }}
                                                    {{ $feedback->seller->last_name ?? '' }}
                                                </strong><br>
                                                {{ $feedback->seller->email ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        {{-- Rating --}}
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $feedback->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <br>
                                            <small>({{ $feedback->rating }}/5)</small>
                                        </td>

                                        {{-- Message --}}
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($feedback->message, 120) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No feedback found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $feedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

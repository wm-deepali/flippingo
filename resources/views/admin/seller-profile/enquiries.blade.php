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
                        <li class="breadcrumb-item active">Seller Enquiries</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Seller Enquiries</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Enquiry ID</th>
                                    <th>Buyer Info</th>
                                    <th>Seller Info</th>
                                    <th>Message</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($enquiries as $enquiry)
                                    <tr>
                                        <td>
                                            {{ $enquiry->created_at->format('d M Y, H:i') }}
                                        </td>

                                        <td>
                                            #{{ $enquiry->id }}
                                        </td>

                                        {{-- Buyer Info (from enquiry table itself) --}}
                                        <td>
                                            <strong>{{ $enquiry->name }}</strong><br>
                                            {{ $enquiry->email }}<br>
                                            {{ $enquiry->mobile }}
                                        </td>

                                        {{-- Seller Info --}}
                                        <td>
                                            @if($enquiry->seller)
                                                <strong>{{ $enquiry->seller->first_name ?? '' }}
                                                    {{ $enquiry->seller->last_name ?? '' }}</strong><br>
                                                {{ $enquiry->seller->email ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            {{ \Illuminate\Support\Str::limit($enquiry->message, 120) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No enquiries found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $enquiries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

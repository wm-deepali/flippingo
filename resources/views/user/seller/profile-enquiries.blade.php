@extends('layouts.user-master')

@section('title', 'Profile Enquiries')

@section('content')
@include('user.sidebar')

<div class="page-wrapper">
    <div class="container-fluid">

        <h3 class="mb-4">Seller Profile Enquiries</h3>

        <div class="card">
            <div class="card-body">

                @if($enquiries->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enquiries as $index => $enquiry)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->mobile ?? '-' }}</td>
                                        <td style="max-width:300px;">
                                            {{ Str::limit($enquiry->message, 80) }}
                                        </td>
                                        <td>{{ $enquiry->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No profile enquiries received yet.</p>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection

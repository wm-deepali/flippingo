@extends('layouts.user-master')

@section('title', 'My Profile Enquiries')

@section('content')

@include('user.sidebar')

<div class="page-wrapper">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="page-title">My Seller Profile Enquiries</h3>
                <p class="text-muted">Enquiries you sent from seller profile pages</p>
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
                                <th>Message</th>
                                <th>Sent On</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($enquiries as $index => $enquiry)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>
                                        <strong>
                                            {{ $enquiry->seller->legal_name
                                                ?? trim($enquiry->seller->first_name . ' ' . $enquiry->seller->last_name) }}
                                        </strong>
                                    </td>

                                    <td style="max-width:300px;">
                                        {{ \Illuminate\Support\Str::limit($enquiry->message, 80) }}
                                    </td>

                                    <td>
                                        {{ $enquiry->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span class="badge bg-info">
                                            Sent
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        You haven’t sent any seller profile enquiries yet.
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

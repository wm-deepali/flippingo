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
                                    <li class="breadcrumb-item active">Enquiries</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">

                        {{-- Enquiries Table --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Enquiries</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="enquiries-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Submission ID</th>
                                                <th>Customer (Enquirer)</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($enquiries as $enquiry)
                                                <tr>
                                                    <td>{{ $enquiry->id }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.form-submissions.show', $enquiry->submission->id ?? '#') }}">
                                                            {{ $enquiry->submission_id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $enquiry->customer->first_name }}
                                                        {{  $enquiry->customer->last_name }}
                                                    </td>
                                                    <td>{{ Str::limit($enquiry->message, 100) }}</td>
                                                    <td>
                                                        @if($enquiry->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif($enquiry->status == 'completed')
                                                            <span class="badge badge-success">Completed</span>
                                                        @else
                                                            <span
                                                                class="badge badge-secondary">{{ ucfirst($enquiry->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $enquiry->created_at->format('d M Y H:i') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No enquiries found.</td>
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
        </div>
    </div>
@endsection
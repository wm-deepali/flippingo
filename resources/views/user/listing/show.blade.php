@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Listing Details' }}
@endsection

@section('content')
    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="listing-and-product">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Listing Details</h3>
                <a href="{{ route('dashboard.listing') }}" class="btn btn-sm btn-secondary">
                    ← Back to Listings
                </a>
            </div>

            <!-- Basic Information -->
            <div class="card">
                <div class="card-header">
                    <h4>Basic Information</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Form</dt>
                        <dd class="col-sm-9">{{ $submission->form->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Submitted By</dt>
                        <dd class="col-sm-9">{{ $submission->customer->first_name ?? ' ' }}
                            {{ $submission->customer->last_name ?? '' }}
                        </dd>

                        <dt class="col-sm-3">Submitted On</dt>
                        <dd class="col-sm-9">{{ $submission->created_at->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-3">Status</dt>
                       <dd class="col-sm-9">
                          @switch($submission->status)
                            @case('pending')
                                <span class="badge badge-secondary">Recent</span>
                                @break
                            @case('published')
                                <span class="badge badge-success">Published</span>
                                @break
                            @case('expired')
                                <span class="badge badge-warning">Expired</span>
                                @break
                            @case('rejected')
                                <span class="badge badge-danger">Rejected</span>
                                @break
                            @default
                                <span class="badge badge-light">{{ ucfirst($submission->status) }}</span>
                        @endswitch
                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Submission Data -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Submission Data</h4>
                </div>
                <div class="card-body">
                    @if(!empty($mappedData))
                        <dl class="row">
                            @foreach($mappedData as $label => $data)
                                <dt class="col-sm-4">{{ $label }} :</dt>
                                @php $val = $data['value'] ?? $data; @endphp
                                <dd class="col-sm-8">
                                    @if(is_array($val) || is_object($val))
                                        <pre>{{ json_encode($val, JSON_PRETTY_PRINT) }}</pre>
                                    @else
                                        {{ $val }}
                                    @endif
                                </dd>
                            @endforeach
                        </dl>
                    @else
                        <p>No submission data available.</p>
                    @endif
                </div>
            </div>

            <!-- Files Section -->
            @if($submission->files->count() > 0)
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Uploaded Files</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Field Name</th>
                                    <th>Original File Name</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submission->files as $file)
                                    <tr>
                                        <td>{{ $file->field_name ?? '-' }}</td>
                                        <td>{{ $file->original_name ?? 'Unnamed' }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-primary">
                                                View File
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

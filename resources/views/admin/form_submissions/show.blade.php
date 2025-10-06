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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.form-submissions.index') }}">Form
                                            Submissions</a></li>
                                    <li class="breadcrumb-item active">View Form Submission Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <a href="{{ route('admin.form-submissions.index') }}" class="btn btn-primary btn-sm">Back to List</a>
                </div>
            </div>


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

           <div class="card mt-4">
    <div class="card-header">
        <h4>Submission Data</h4>
    </div>
    <div class="card-body">
        @if(!empty($mappedData))
            <dl class="row">
                @foreach($mappedData as $label => $data)
                   @php
    $val = $data['value'] ?? '';
    if (!empty($data['child_value'])) {
        $val .= ' → ' . $data['child_value'];
    }
@endphp
                    <dt class="col-sm-4">{{ $label }} :</dt>
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
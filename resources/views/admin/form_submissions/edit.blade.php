@extends('layouts.master')

@section('title', 'Edit Listing')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.form-submissions.index') }}">Manage
                                            Submission</a></li>
                                    <li class="breadcrumb-item active">Edit Submission</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="{{ route('admin.form-submissions.index') }}"
                            class="btn-icon btn btn-secondary btn-round btn-sm">Back to
                            Submission</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Submission</h4>
                            </div>
                            <div class="card-body">
                                    <form id="edit-submission-form" enctype="multipart/form-data"
      data-action="{{ route('admin.form-submissions.update', $submission->id) }}">
    @csrf
    @method('PUT')

                                        @php
                                            $inputTypes = ['text', 'email', 'number', 'select', 'dropdown', 'file', 'signature', 'textarea', 'date', 'checkbox', 'radio']; // Add all form input types you support
                                        @endphp

                                        @foreach($formData->fields as $field)
                                            @if(in_array($field['type'], $inputTypes))
                                                @php
                                                    $fieldKey = $field['properties']['id'] ?? $field['id'];
                                                    $type = $field['type'];
                                                    $label = $field['properties']['label'] ?? $fieldKey;
                                                    $icon = $field['properties']['icon'] ?? '';
                                                    $multiple = $field['properties']['multiple'] ?? false;
                                                    $value = $existingData[$fieldKey]['value'] ?? '';
                                                @endphp

                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        @if($icon)<i class="{{ $icon }}"></i>@endif
                                                        {{ $label }}
                                                    </label>

                                                    {{-- Render input based on type --}}
                                                    @if($type === 'file')
                                                        <input type="file" name="{{ $multiple ? $fieldKey . '[]' : $fieldKey }}"
                                                            class="form-control" @if($multiple) multiple @endif>
                                                       @foreach($uploadedFiles->where('field_id', $fieldKey) as $file)
    <div class="mt-2 d-flex align-items-center gap-3">
        {{-- Image preview --}}
        @if(str_starts_with($file->mime_type, 'image/'))
            <img src="{{ asset('storage/' . $file->file_path) }}" alt="{{ $file->original_name }}" style="max-height: 80px; border: 1px solid #ddd; padding: 2px;">
        {{-- Video preview --}}
        @elseif(str_starts_with($file->mime_type, 'video/'))
            <video width="120" height="80" controls>
                <source src="{{ asset('storage/' . $file->file_path) }}" type="{{ $file->mime_type }}">
                Your browser does not support the video tag.
            </video>
        @else
            {{-- For other files show icon or original name --}}
            <i class="bi bi-file-earmark-fill"></i> {{ $file->original_name }}
        @endif


    </div>
@endforeach

                                                    @elseif($type === 'signature')
                                                        <canvas id="signature_{{ $fieldKey }}" width="300" height="100"
                                                            style="border:1px solid #ccc;"></canvas>
                                                        <input type="hidden" name="{{ $fieldKey }}" id="hidden_signature_{{ $fieldKey }}"
                                                            value="{{ $value }}">
                                                        <button type="button" class="btn btn-secondary btn-sm mt-1"
                                                            id="clear_signature_{{ $fieldKey }}">Clear</button>
                                                    @elseif(in_array($type, ['select', 'dropdown']))
                                                        <select name="{{ $fieldKey }}" class="form-control">
                                                            @foreach($field['properties']['options'] ?? [] as $optionValue => $optionLabel)
                                                                <option value="{{ $optionValue }}" @if($optionValue == $value) selected @endif>
                                                                    {{ $optionLabel }}</option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <input type="{{ $type }}" name="{{ $fieldKey }}" value="{{ $value }}"
                                                            class="form-control">
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach

                                    <button type="submit" class="btn btn-primary">Update Submission</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#edit-submission-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let url = form.data('action'); // use data-action instead of action
        let formData = new FormData(this);

        // Disable button & show loader
        let submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: url,
            method: 'POST', // Laravel PUT spoofing (_method=PUT) already included
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message || 'Submission updated successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Redirect after short delay
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.form-submissions.index') }}";
                    }, 1600);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message || 'Something went wrong.'
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).map(errArr => errArr[0]).join('<br>');

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Please try again later.'
                    });
                }
            },
            complete: function () {
                submitBtn.prop('disabled', false).text('Update Submission');
            }
        });
    });
});
</script>

@endpush

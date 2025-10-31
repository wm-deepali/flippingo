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
                                        $inputTypes = ['text', 'email', 'number', 'selectlist', 'dropdown', 'file', 'signature', 'textarea', 'date', 'checkbox', 'radio', 'cascadingDropdown']; // Add all form input types you support
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
                                                                <img src="{{ asset('storage/' . $file->file_path) }}"
                                                                    alt="{{ $file->original_name }}"
                                                                    style="max-height: 80px; border: 1px solid #ddd; padding: 2px;">
                                                                {{-- Video preview --}}
                                                            @elseif(str_starts_with($file->mime_type, 'video/'))
                                                                <video width="120" height="80" controls>
                                                                    <source src="{{ asset('storage/' . $file->file_path) }}"
                                                                        type="{{ $file->mime_type }}">
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
                                                @elseif(in_array($type, ['selectlist', 'dropdown']))
    @php
        $options = $field['properties']['options'] ?? [];
    @endphp
    <select name="{{ $fieldKey }}" class="form-control">
        @foreach($options as $option)
            @php
                // Split option by "|selected"
                $isSelectedDefault = false;
                $optionLabel = $option;

                if (str_contains($option, '|selected')) {
                    $optionLabel = str_replace('|selected', '', $option);
                    $isSelectedDefault = true;
                }

                // Determine selected: from existing data or default option
                $selected = ($value == $optionLabel) || (!$value && $isSelectedDefault);
            @endphp

            <option value="{{ $optionLabel }}" @if($selected) selected @endif>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

                                                @elseif($type === 'cascadingDropdown')
                                                    @php
                                                        $parentValue = $existingData[$fieldKey]['value'] ?? '';
                                                        $childValue = $existingData[$fieldKey]['child_value'] ?? '';
                                                        $parentOptions = $field['properties']['parentOptions'] ?? [];
                                                        $childMapping = $field['properties']['parentChildMapping'] ?? [];
                                                    @endphp

                                                    <div class="mb-3">
                                                       {{-- Parent Dropdown --}}
<select class="form-control parent-dropdown" name="{{ $fieldKey }}">
    <option value="">Select parent</option>
    @foreach($parentOptions as $option)
        <option value="{{ $option }}" @if($option == $parentValue) selected @endif>
            {{ $option }}
        </option>
    @endforeach

    @if(!empty($field['properties']['enableParentOther']) && $field['properties']['enableParentOther'] == true)
        <option value="Other" @if($parentValue == 'Other') selected @endif>Other</option>
    @endif
</select>


                                                        {{-- Child Dropdown --}}
                                                        <select class="form-control mt-2 child-dropdown" name="{{ $fieldKey }}_child">
                                                            <option value="">Select child</option>
                                                            @if($parentValue && isset($childMapping[$parentValue]))
                                                                @foreach($childMapping[$parentValue] as $childOption)
                                                                    <option value="{{ $childOption }}" @if($childOption == $childValue) selected
                                                                    @endif>{{ $childOption }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                               
                                                @elseif($type === 'textarea')
                                                    <textarea name="{{ $fieldKey }}" class="form-control"
                                                        rows="3">{{ is_array($value) ? implode(', ', $value) : $value }}</textarea>

                                               @elseif($type === 'checkbox')
    <label class="form-label fw-bold">{{ $field['properties']['label'] ?? '' }}</label>

    @foreach($field['properties']['checkboxes'] ?? [] as $checkbox)
        @php
            // Split by "|" and trim spaces
            $parts = array_map('trim', explode('|', $checkbox));

            // Label and value
            $label = $parts[0] ?? '';
            $value = $parts[1] ?? $label; // fallback if no value part
            $isSelected = isset($parts[2]) && strtolower($parts[2]) === 'selected';
        @endphp

        <div class="form-check">
            <input class="form-check-input"
                type="checkbox"
                name="{{ $field['properties']['field_id'] ?? '' }}[]"
                value="{{ $value }}"
                @if((is_array($value ?? null) && in_array($value, $value ?? [])) || $isSelected) checked @endif
            >
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
                                               @elseif($type === 'radio')
    <label class="form-label fw-bold">{{ $field['properties']['label'] ?? '' }}</label>

    @foreach($field['properties']['radios'] ?? [] as $radio)
        @php
            // Split the radio string (Label | Value | selected)
            $parts = array_map('trim', explode('|', $radio));

            $label = $parts[0] ?? '';
            $optionValue = $parts[1] ?? $label; // fallback if value not given
            $isSelected = isset($parts[2]) && strtolower($parts[2]) === 'selected';
        @endphp

        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="{{ $field['properties']['field_id'] ?? $fieldKey }}"
                value="{{ $optionValue }}"
                @if(($value ?? '') == $optionValue || $isSelected) checked @endif
            >
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach


                                                @elseif($type === 'date')
                                                    <input type="date" name="{{ $fieldKey }}"
                                                        value="{{ is_array($value) ? '' : $value }}" class="form-control">

                                                @else
                                                    @php
                                                        $displayValue = is_array($value) ? implode(', ', $value) : $value;
                                                    @endphp
                                                    <input type="{{ $type }}" name="{{ $fieldKey }}" value="{{ $displayValue }}"
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
    // Build mapping for all cascading dropdowns
    const childMapping = {};
    @foreach($formData->fields as $field)
        @if($field['type'] === 'cascadingDropdown')
            childMapping['{{ $field['properties']['id'] ?? $field['id'] }}'] = @json($field['properties']['parentChildMapping'] ?? []);
        @endif
    @endforeach

    $('.parent-dropdown').each(function () {
        const parent = $(this);
        const fieldName = parent.attr('name');
        const child = $(`select[name="${fieldName}_child"]`);

        // Existing values (for edit mode)
        const parentValue = parent.val();
        const customValue = @json($existingData)[fieldName]?.child_custom_value ?? null;

        // Hide child dropdown if no parent
        if (!parentValue) child.closest('.mb-3').find('.child-dropdown').hide();

        // --- Handle edit mode for "Other" ---
        if (parentValue === 'Other') {
            child.closest('.mb-3').find('.child-dropdown').hide();

            const existingVal = customValue ? customValue.replace(/^,/, '') : '';
            const inputHtml = `
                <div class="form-group mt-2" id="parent-other-group-${fieldName}">
                    <input type="text" class="form-control"
                           id="parent-other-input-${fieldName}"
                           name="${fieldName}_child_custom"
                           value="${existingVal}"
                           placeholder="Enter your option">
                </div>`;
            if (!$(`#parent-other-group-${fieldName}`).length) {
                child.closest('.mb-3').append(inputHtml);
            }
        }

        // --- Handle change dynamically ---
        parent.off('change').on('change', function () {
            const selectedParent = $(this).val();

            // Remove custom input if any
            $(`#parent-other-group-${fieldName}`).remove();

            // Handle "Other"
            if (selectedParent === 'Other') {
                child.closest('.mb-3').find('.child-dropdown').hide();
                const inputHtml = `
                    <div class="form-group mt-2" id="parent-other-group-${fieldName}">
                        <input type="text" class="form-control"
                               id="parent-other-input-${fieldName}"
                               name="${fieldName}_child_custom"
                               placeholder="Enter your option">
                    </div>`;
                child.closest('.mb-3').append(inputHtml);
            }
            // Handle normal parent-child mapping
            else if (selectedParent && childMapping[fieldName] && childMapping[fieldName][selectedParent]) {
                $(`#parent-other-group-${fieldName}`).remove();
                child.empty().append('<option value="">Select child</option>');
                childMapping[fieldName][selectedParent].forEach(opt => {
                    child.append(`<option value="${opt}">${opt}</option>`);
                });
                child.closest('.mb-3').find('.child-dropdown').show();
            }
            // Handle empty parent
            else {
                child.closest('.mb-3').find('.child-dropdown').hide();
            }
        });
    });

    // --- AJAX Form Submission ---
    $('#edit-submission-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const url = form.data('action');
        const formData = new FormData(this);

        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: url,
            method: 'POST', // PUT spoofing handled via hidden _method
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
                    const errors = xhr.responseJSON.errors;
                    const errorMessages = Object.values(errors).map(errArr => errArr[0]).join('<br>');
                    Swal.fire({ icon: 'error', title: 'Validation Error', html: errorMessages });
                } else {
                    Swal.fire({ icon: 'error', title: 'Server Error', text: 'Please try again later.' });
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

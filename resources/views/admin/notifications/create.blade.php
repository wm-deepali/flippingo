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
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Create Notification</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Admin Notification</h4>
                        </div>
                        <div class="card-body">
                            <form id="notification-form" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="use_template" id="use_template" value="1">
                                    <label class="form-check-label" for="use_template">Save this notification as a template</label>
                                </div>

                                <div class="form-group" id="template-key-group" style="display:none;">
                                    <label for="template_key">Template Key</label>
                                    <input type="text" name="template_key" id="template_key" class="form-control">
                                    <small class="text-muted">Unique key for this template (required if saving as template)</small>
                                </div>

                                <div class="form-group">
                                    <label for="send_to">Send To</label>
                                    <select name="send_to[]" id="send_to" class="form-control" multiple>
                                        <option value="all">All Customers</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->first_name }} ({{ $customer->email }})</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Search and select multiple customers or choose "All Customers"</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Send Notification</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {

    // Initialize Select2
    $('#send_to').select2({
        placeholder: "Search customers or choose All Customers",
        allowClear: true
    });

    // Show/hide template key input
    $('#use_template').change(function(){
        if($(this).is(':checked')){
            $('#template-key-group').show();
            $('#template_key').attr('required', true);
        } else {
            $('#template-key-group').hide();
            $('#template_key').removeAttr('required');
        }
    });

    // AJAX form submission
    $('#notification-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: "{{ route('admin.notifications.store') }}",
            type: "POST",
            data: formData,
            beforeSend: function () {
                form.find('button[type="submit"]').prop('disabled', true).text('Sending...');
            },
            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: res.message || 'Notification sent successfully.'
                });
                form[0].reset();
                $('#send_to').val(null).trigger('change');
                $('#template-key-group').hide();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                let errorMsg = errors ? Object.values(errors).flat().join("\n") : 'Something went wrong!';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg
                });
            },
            complete: function () {
                form.find('button[type="submit"]').prop('disabled', false).text('Send Notification');
            }
        });

    });

});
</script>
@endpush

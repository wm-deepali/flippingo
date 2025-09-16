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
                                    <li class="breadcrumb-item active">Admin Notifications</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary btn-round btn-sm">
                            Create Notification
                        </a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Admin-Created Notifications</h4>
                            </div>

                            <div class="card-body">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="adminNotifTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="templates-tab" data-toggle="tab" href="#templates"
                                            role="tab">Templates</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications"
                                            role="tab">Sent Notifications</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3">
                                    <!-- Templates Tab -->
                                    <!-- Templates Tab -->
                                    <div class="tab-pane fade show active" id="templates" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table" id="templates-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Key</th>
                                                        <th>Subject</th>
                                                        <th>Content</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($templates as $template)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $template->key }}</td>
                                                            <td>{{ $template->subject }}</td>
                                                            <td>{{ $template->content }}</td>
                                                            <td>{{ $template->created_at->format('d M Y, h:i A') }}</td>
                                                            <td>
                                                                <button class="btn btn-success btn-sm send-template-btn"
                                                                    data-id="{{ $template->id }}"
                                                                    data-subject="{{ $template->subject }}"
                                                                    data-content="{{ $template->content }}" data-toggle="modal"
                                                                    data-target="#sendTemplateModal">
                                                                    Send
                                                                </button>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Resend Modal (now for sending from template) -->
                                    <div class="modal fade" id="sendTemplateModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form id="send-template-form">
                                                    @csrf
                                                    <input type="hidden" name="template_id" id="template_id">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Send Notification from Template</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Subject</label>
                                                            <input type="text" class="form-control" name="subject"
                                                                id="template_subject" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content</label>
                                                            <textarea class="form-control" name="content"
                                                                id="template_content" rows="4" readonly></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Send To</label>
                                                            <select class="form-control" name="send_to[]"
                                                                id="template_send_to" multiple>
                                                                <option value="all">All Customers</option>
                                                                @foreach($customers as $customer)
                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->first_name }} ({{ $customer->email }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- Sent Notifications Tab -->
                                    <div class="tab-pane fade" id="notifications" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table" id="notifications-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Subject</th>
                                                        <th>Content</th>
                                                        <th>Template Key</th>
                                                        <th>Sent To</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($templates as $template)
                                                        @foreach ($template->notifications as $notification)
                                                            <tr>
                                                                <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                                                                <td>{{ $notification->subject }}</td>
                                                                <td>{{ $notification->content }}</td>
                                                                <td>{{ $notification->template?->key ?? '-' }}</td>
                                                                <td>
                                                                    @if($notification->is_broadcast)
                                                                        All Customers
                                                                    @else
                                                                        {{ $notification->customers->pluck('first_name')->join(', ') }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $notification->created_at->format('d M Y, h:i A') }}</td>

                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tabs -->
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

            $('#template_send_to').select2({
                placeholder: "Search customers or choose All Customers",
                allowClear: true
            });

            // Send template button
            $('.send-template-btn').on('click', function () {
                let btn = $(this);
                $('#template_id').val(btn.data('id'));
                $('#template_subject').val(btn.data('subject'));
                $('#template_content').val(btn.data('content'));
                $('#template_send_to').val(null).trigger('change');
                $('#sendTemplateModal').modal('show'); // Optional if not using data-toggle
            });

            // AJAX submit
            $('#send-template-form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.notifications.sendFromTemplate') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#send-template-form button[type="submit"]').prop('disabled', true).text('Sending...');
                    },
                    success: function (res) {
                        Swal.fire('Success', res.message, 'success');
                        $('#sendTemplateModal').modal('hide');
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorMsg = errors ? Object.values(errors).join("\n") : 'Something went wrong!';
                        Swal.fire('Error', errorMsg, 'error');
                    },
                    complete: function () {
                        $('#send-template-form button[type="submit"]').prop('disabled', false).text('Send');
                    }
                });
            });
        });
    </script>
@endpush
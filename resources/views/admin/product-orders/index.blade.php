@extends('layouts.master')

@section('title', 'Manage Orders')

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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Orders</h4>
                </div>

                <div class="card-body">

                    {{-- Tabs --}}
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach(['recent','approved','processing','delivered','cancelled','deleted'] as $key)
                            <li class="nav-item">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        data-toggle="tab"
                                        data-target="#{{ $key }}"
                                        type="button">
                                    {{ ucfirst($key) }} Orders
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Tab Content --}}
                    <div class="tab-content mt-2">
                       @foreach(['recent','approved','processing','delivered','cancelled','deleted'] as $status)
    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $status }}">
        @include('admin.product-orders.table', [
            'orders' => $ordersByStatus[$status]
        ])

        <div class="mt-2">
            {{ $ordersByStatus[$status]->links() }}
        </div>
    </div>
@endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="updateStatusForm">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="newStatus" class="form-control" required>
                            <option value="recent">Recent</option>
                            <option value="approved">Approved</option>
                            <option value="processing">Processing</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="deleted">Deleted</option>
                        </select>
                    </div>

                    {{-- Remarks --}}
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="remarks" id="statusRemarks"
                                  class="form-control"
                                  rows="3"
                                  required></textarea>
                    </div>

                    {{-- Delivered Fields --}}
                    <div class="form-group delivered-fields d-none">
                        <label>Delivery Date</label>
                        <input type="date" id="deliveryDate" class="form-control">

                        <label class="mt-1">Delivery Method</label>
                        <input type="text" id="deliveryMethod" class="form-control">
                    </div>

                    {{-- Cancelled Fields --}}
                    <div class="form-group cancelled-fields d-none">
                        <label>Cancellation Reason</label>
                        <select id="cancellationReason"
                                name="cancellation_reason"
                                class="form-control"
                                disabled>
                            <option value="">Select reason</option>
                            @foreach($reasons as $id => $reason)
                                <option value="{{ $id }}">{{ $reason }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Update Status
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentOrderId = null;

/* Allowed transitions */
const allowedNextStatuses = {
    recent: ['approved','processing','delivered','cancelled','deleted'],
    approved: ['processing','delivered','cancelled','deleted'],
    processing: ['delivered','cancelled','deleted'],
    delivered: [],
    cancelled: [],
    deleted: []
};

/* Open Modal */
$(document).on('click', '.changeStatusBtn', function () {
    currentOrderId = $(this).data('id');
    $('#updateStatusForm').data('order-id', currentOrderId);

    let currentStatus = $(this).data('status');

    $('#newStatus option').each(function () {
        $(this).toggle(
            allowedNextStatuses[currentStatus].includes($(this).val())
        );
    });

    $('#newStatus').val($('#newStatus option:visible:first').val()).trigger('change');

    $('#statusRemarks').val($(this).data('remarks') || '');
    $('#deliveryDate').val($(this).data('delivery-date') || '');
    $('#deliveryMethod').val($(this).data('delivery-method') || '');
    $('#cancellationReason').val($(this).data('cancellation-reason') || '');

    $('#statusModal').modal('show');
});

/* Toggle conditional fields */
$('#newStatus').on('change', function () {
    let val = $(this).val();

    if (val === 'delivered') {
        $('.delivered-fields').removeClass('d-none');
        $('.cancelled-fields').addClass('d-none');
        $('#cancellationReason').prop('required', false).prop('disabled', true);

    } else if (val === 'cancelled') {
        $('.cancelled-fields').removeClass('d-none');
        $('.delivered-fields').addClass('d-none');
        $('#cancellationReason').prop('disabled', false).prop('required', true);

    } else {
        $('.delivered-fields, .cancelled-fields').addClass('d-none');
        $('#cancellationReason').prop('required', false).prop('disabled', true);
    }
});

/* Submit AJAX */
$(document).on('submit', '#updateStatusForm', function (e) {
    e.preventDefault();

    let orderId = $(this).data('order-id');

    $.ajax({
        url: '/admin/product-orders/' + orderId + '/update-status',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            _method: 'PATCH',
            status: $('#newStatus').val(),
            remarks: $('#statusRemarks').val(),
            delivery_date: $('#deliveryDate').val(),
            delivery_method: $('#deliveryMethod').val(),
            cancellation_reason: $('#cancellationReason').val()
        },
        success: function (res) {
            $('#statusModal').modal('hide');
            Swal.fire('Success', res.message, 'success');
            location.reload();
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire('Error', 'Something went wrong', 'error');
        }
    });
});
</script>
@endpush

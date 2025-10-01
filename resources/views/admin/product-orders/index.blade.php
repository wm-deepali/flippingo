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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Manage Orders</li>
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
                            <h4 class="card-title">Sales Orders</h4>
                        </div>
                        <div class="card-body">

                            <!-- Tabs navigation -->
                            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                                <li class="nav-item"><button class="nav-link active" data-toggle="tab"
                                        data-target="#recent" type="button">Recent Orders</button></li>
                                <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#approved"
                                        type="button">Approved Orders</button></li>
                                <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#processing"
                                        type="button">Under Process</button></li>
                                <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#delivered"
                                        type="button">Delivered Orders</button></li>
                                <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#cancelled"
                                        type="button">Cancelled Orders</button></li>
                                <li class="nav-item"><button class="nav-link" data-toggle="tab" data-target="#deleted"
                                        type="button">Deleted Orders</button></li>
                            </ul>

                            <!-- Tabs content -->
                            <div class="tab-content">
                                @foreach(['recent','approved','processing','delivered','cancelled','deleted'] as $status)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $status }}">
                                        @include('admin.product-orders.table', [
                                            'orders' => $orders->filter(fn($order) => $order->currentStatus?->status === $status)
                                        ])
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateStatusForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Status Selector -->
                    <div class="form-group">
                        <label for="newStatus">Select New Status</label>
                        <select name="status" id="newStatus" class="form-control" required>
                            <option value="recent">Recent</option>
                            <option value="approved">Approved</option>
                            <option value="processing">Processing</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="deleted">Deleted</option>
                        </select>
                    </div>

                    <!-- Remarks -->
                    <div class="form-group">
                        <label for="statusRemarks">Remarks</label>
                        <textarea name="remarks" id="statusRemarks" class="form-control" rows="4" placeholder="Enter remarks..." required></textarea>
                    </div>

                    <!-- Delivered-specific fields -->
                    <div class="form-group delivered-fields d-none">
                        <label>Delivery Date</label>
                        <input type="date" id="deliveryDate" class="form-control" />
                        <label>Delivery Method</label>
                        <input type="text" id="deliveryMethod" class="form-control" />
                    </div>

                    <!-- Cancelled-specific fields -->
                   <div class="form-group cancelled-fields d-none">
    <label>Cancellation Reason</label>
    <select id="cancellationReason" class="form-control" required>
        <option value="">Select reason</option>
        @foreach($reasons as $id => $reason)
            <option value="{{ $id }}">{{ $reason }}</option>
        @endforeach
    </select>
</div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentOrderId = null;

const allowedNextStatuses = {
    recent: ['approved','processing', 'delivered', 'cancel_requested', 'cancelled', 'deleted'],
    approved: ['processing', 'delivered', 'cancel_requested', 'cancelled', 'deleted'],
    processing: ['delivered', 'cancel_requested', 'cancelled', 'deleted'],
    delivered: [], // cannot go back
    cancel_requested: ['cancelled', 'deleted'],
    cancelled: [], // cannot go back
    deleted: [] // cannot go back
};



$(document).on('click', '.changeStatusBtn', function() {
    currentOrderId = $(this).data('id');
    $('#updateStatusForm').data('order-id', currentOrderId);

    let currentStatus = $(this).data('status');

    // Show all options first
    $('#newStatus option').show();

    // Hide options that are not allowed
    $('#newStatus option').each(function() {
        let val = $(this).val();
        if (!allowedNextStatuses[currentStatus].includes(val)) {
            $(this).hide();
        }
    });

    // Select first visible option automatically
    $('#newStatus').val($('#newStatus option:visible:first').val()).trigger('change');

    $('#statusRemarks').val($(this).data('remarks'));
    $('#deliveryDate').val($(this).data('delivery-date'));
    $('#deliveryMethod').val($(this).data('delivery-method'));
    $('#cancellationReason').val($(this).data('cancellation-reason'));

   var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
myModal.show();
});


// Show/hide fields based on status
$('#newStatus').on('change', function() {
    let val = $(this).val();
    if(val === 'delivered'){
        $('.delivered-fields').removeClass('d-none');
        $('.cancelled-fields').addClass('d-none');
    } else if(val === 'cancelled'){
        $('.cancelled-fields').removeClass('d-none');
        $('.delivered-fields').addClass('d-none');
    } else {
        $('.delivered-fields, .cancelled-fields').addClass('d-none');
    }
});

// Submit AJAX request
$('#updateStatusForm').on('submit', function(e) {
    e.preventDefault();

    let orderId = $(this).data('order-id');
    let status = $('#newStatus').val();
    let remarks = $('#statusRemarks').val();
    let token = $('input[name="_token"]').val();

    let data = { _token: token, status, remarks };

    if(status === 'delivered') {
        data.delivery_date = $('#deliveryDate').val();
        data.delivery_method = $('#deliveryMethod').val();
    }
    if(status === 'cancelled') {
        data.cancellation_reason = $('#cancellationReason').val();
    }

    $.ajax({
        url: '/admin/product-orders/' + orderId + '/update-status',
        method: 'PATCH',
        data: data,
        success: function(response) {
            $('#statusModal').modal('hide');
            Swal.fire('Success', response.message, 'success');

            let row = $('button[data-id="' + orderId + '"]').closest('tr');
            row.find('td:nth-child(8) span').text(status.charAt(0).toUpperCase() + status.slice(1));
            if(row.find('td.remarks').length) {
                row.find('td.remarks').text(remarks);
            }
                location.reload();

        },
        error: function() {
            Swal.fire('Error', 'Something went wrong! Please try again.', 'error');
        }
    });
});


</script>
@endpush

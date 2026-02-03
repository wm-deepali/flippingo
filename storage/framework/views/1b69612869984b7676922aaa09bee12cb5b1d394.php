

<?php $__env->startSection('title', 'Manage Orders'); ?>

<?php $__env->startSection('content'); ?>

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
                                    <a href="<?php echo e(route('home')); ?>">Home</a>
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

                    
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $__currentLoopData = ['recent','approved','processing','delivered','cancelled','deleted']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <button class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>"
                                        data-toggle="tab"
                                        data-target="#<?php echo e($key); ?>"
                                        type="button">
                                    <?php echo e(ucfirst($key)); ?> Orders
                                </button>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    
                    <div class="tab-content mt-2">
                        <?php $__currentLoopData = ['recent','approved','processing','delivered','cancelled','deleted']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="<?php echo e($status); ?>">
                                <?php echo $__env->make('admin.product-orders.table', [
                                    'orders' => $orders->filter(
                                        fn($order) => $order->currentStatus?->status === $status
                                    )
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="updateStatusForm">
            <?php echo csrf_field(); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    
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

                    
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="remarks" id="statusRemarks"
                                  class="form-control"
                                  rows="3"
                                  required></textarea>
                    </div>

                    
                    <div class="form-group delivered-fields d-none">
                        <label>Delivery Date</label>
                        <input type="date" id="deliveryDate" class="form-control">

                        <label class="mt-1">Delivery Method</label>
                        <input type="text" id="deliveryMethod" class="form-control">
                    </div>

                    
                    <div class="form-group cancelled-fields d-none">
                        <label>Cancellation Reason</label>
                        <select id="cancellationReason"
                                name="cancellation_reason"
                                class="form-control"
                                disabled>
                            <option value="">Select reason</option>
                            <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($reason); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/product-orders/index.blade.php ENDPATH**/ ?>
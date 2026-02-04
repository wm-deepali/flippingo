

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
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Withdrawal Requests</li>
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
                                <h4>Withdrawal Requests</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Amount (₹)</th>
                                                <th>Status</th>
                                                <th>Payment Method</th>
                                                <th>Requested At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($req->id); ?></td>
                                                    <td>
                                                        <?php echo e($req->customer->customer_id ?? '-'); ?><br>
                                                        <?php echo e($req->customer->first_name ?? ''); ?>

                                                        <?php echo e($req->customer->last_name ?? ''); ?><br>
                                                        <?php echo e($req->customer->email ?? '-'); ?>

                                                    </td>
                                                    <td>₹<?php echo e(number_format($req->amount, 2)); ?></td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                                        <?php echo e($req->status == 'pending' ? 'bg-warning' : ($req->status == 'approved' ? 'bg-success' : 'bg-danger')); ?>">
                                                            <?php echo e(ucfirst($req->status)); ?>

                                                        </span>
                                                    </td>
                                                   <td>
    <?php if($req->paymentMethod): ?>
        <strong>Type:</strong> <?php echo e($req->paymentMethod->type); ?><br>

        <?php switch($req->paymentMethod->type):
            case ('bank'): ?>
                <strong>Account Name:</strong> <?php echo e($req->paymentMethod->account_holder_name ?? '-'); ?><br>
                <strong>Account Number:</strong> <?php echo e($req->paymentMethod->account_number ?? '-'); ?><br>
                <strong>Bank:</strong> <?php echo e($req->paymentMethod->bank_name ?? '-'); ?><br>
                <strong>IFSC:</strong> <?php echo e($req->paymentMethod->ifsc_code ?? '-'); ?>

                <?php break; ?>

            <?php case ('upi'): ?>
                <strong>Receiver Name:</strong> <?php echo e($req->paymentMethod->receiver_name ?? '-'); ?><br>
                <strong>UPI ID:</strong> <?php echo e($req->paymentMethod->upi_id ?? '-'); ?>

                <?php break; ?>

            <?php case ('paypal'): ?>
                <strong>PayPal Email:</strong> <?php echo e($req->paymentMethod->paypal_email ?? '-'); ?>

                <?php break; ?>

                <?php case ('wire'): ?>
                <strong>Account Name:</strong> <?php echo e($req->paymentMethod->account_holder_name ?? '-'); ?><br>
                <strong>Account Number:</strong> <?php echo e($req->paymentMethod->account_number ?? '-'); ?><br>
                <strong>Bank:</strong> <?php echo e($req->paymentMethod->bank_name ?? '-'); ?><br>
                <strong>Bank Address:</strong> <?php echo e($req->paymentMethod->bank_address ?? '-'); ?>

                <strong>Bank Swift Code:</strong> <?php echo e($req->paymentMethod->swift_code ?? '-'); ?>

                <strong>IBAN Number:</strong> <?php echo e($req->paymentMethod->iban_number ?? '-'); ?>

                <?php break; ?>


            <?php default: ?>
                Details not available
        <?php endswitch; ?>
    <?php else: ?>
        -
    <?php endif; ?>
</td>

                                                    <td><?php echo e($req->created_at->format('Y-m-d H:i')); ?></td>
                                                  
                                                    <td>
    <?php if($req->status == 'pending'): ?>
        <button type="button" class="btn btn-success btn-sm approve-btn" 
            data-id="<?php echo e($req->id); ?>">
            Approve
        </button>

        <button type="button" class="btn btn-danger btn-sm reject-btn" 
            data-id="<?php echo e($req->id); ?>">
            Reject
        </button>
    <?php else: ?>
        <span class="badge bg-secondary"><?php echo e(ucfirst($req->status)); ?></span>
    <?php endif; ?>
</td>

                                                   
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <?php echo e($requests->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="approveForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="request_id" id="approve_request_id">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Withdrawal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Payment Date</label>
                        <input type="date" name="payment_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Reference ID</label>
                        <input type="text" name="reference_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Screenshot</label>
                        <input type="file" name="screenshot" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {

    // Open modal and set request ID
    $('.approve-btn').click(function() {
        var id = $(this).data('id');
        $('#approve_request_id').val(id);
        $('#approveModal').modal('show');
    });

    // Open modal and set request ID
    $('.approve-btn').click(function() {
        var id = $(this).data('id');
        $('#approve_request_id').val(id);
        $('#approveModal').modal('show');
    });

    // Submit approve form via AJAX
    $('#approveForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var requestId = $('#approve_request_id').val();

        $.ajax({
            url: '<?php echo e(route("admin.withdrawals.approve", ":id")); ?>'.replace(':id', requestId),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#approveModal').modal('hide');
                Swal.fire('Success', response.message, 'success');
                setTimeout(function() { location.reload(); }, 1000);
            },
            error: function(xhr) {
                let err = xhr.responseJSON?.message || 'Something went wrong';
                Swal.fire('Error', err, 'error');
            }
        });
    });

    // Reject via AJAX
    $('.reject-btn').click(function() {
        var requestId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This will reject the withdrawal request.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: '<?php echo e(route("admin.withdrawals.reject", ":id")); ?>'.replace(':id', requestId),
                    method: 'POST',
                    data: { _token: '<?php echo e(csrf_token()); ?>' },
                    success: function(response) {
                        Swal.fire('Rejected!', response.message, 'success');
                        setTimeout(function() { location.reload(); }, 1000);
                    },
                    error: function(xhr){
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            }
        });
    });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/wallets/withdrawal-requests.blade.php ENDPATH**/ ?>
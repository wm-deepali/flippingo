

<?php $__env->startSection('title', 'Subscription Cancellation Requests'); ?>

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
                                    <li class="breadcrumb-item active">Cancellation Requests</li>
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
                                <h4 class="card-title">Subscription Cancellation Requests</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="cancel-requests-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Order ID</th>
                                                <th>Customer Info</th>
                                                <th>Plan</th>
                                                <th>Subscription Status</th>
                                                <th>Cancel Reason</th>
                                                <th>Requested At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="sub-row-<?php echo e($sub->id); ?>">
                                                    <td><?php echo e(\Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i')); ?></td>
                                                    <td><?php echo e($sub->order_number); ?></td>
                                                    <td>
                                                        <?php echo e($sub->customer->first_name ?? '-'); ?>

                                                        <?php echo e($sub->customer->last_name ?? '-'); ?><br>
                                                        <?php echo e($sub->customer->email ?? '-'); ?>

                                                    </td>
                                                    <td><?php echo e($sub->package->name ?? '-'); ?></td>
                                                    <td>
                                                        <?php if($sub->status === 'cancel_requested'): ?>
                                                            <span class="badge badge-warning">Cancel Requested</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary"><?php echo e(ucfirst($sub->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($sub->cancel_reason ?? '-'); ?></td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($sub->cancel_requested_at)->format('Y-m-d H:i') ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($sub->status === 'cancel_requested'): ?>
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                onclick="openRefundModal(<?php echo e($sub->id); ?>)">Approve</button>
                                                            <form
                                                                action="<?php echo e(route('admin.subscriptions.rejectCancellation', $sub->id)); ?>"
                                                                method="POST" style="display:inline;">
                                                                <?php echo csrf_field(); ?>
                                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                            </form>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Refund Modal -->
    <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="refundForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="subscription_id" id="subscription_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="refundModalLabel">Process Refund</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Refund Method</label>
                            <select name="refund_method" id="refund_method" class="form-control"
                                onchange="toggleRefundFields()">
                                <option value="">Select Refund Method</option>
                                <option value="source_account">Process Refund to Source Account</option>
                                <option value="wallet">Process Refund to User Wallet</option>
                            </select>
                        </div>

                        <div id="sourceAccountFields" style="display:none;">
                            <div class="form-group">
                                <label>Payment Date</label>
                                <input type="date" name="payment_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Reference ID</label>
                                <input type="text" name="reference_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload Screenshot</label>
                                <input type="file" name="screenshot" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitRefund()">Submit Refund &
                            Approve</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        let currentSubId = null;

        function openRefundModal(subId) {
            currentSubId = subId;
            document.getElementById('subscription_id').value = subId;
            document.getElementById('refund_method').value = '';
            document.getElementById('sourceAccountFields').style.display = 'none';
            $('#refundModal').modal('show');
        }

        function toggleRefundFields() {
            const method = document.getElementById('refund_method').value;
            const sourceFields = document.getElementById('sourceAccountFields');
            sourceFields.style.display = method === 'source_account' ? 'block' : 'none';
        }

        function submitRefund() {
            const form = document.getElementById('refundForm');
            const formData = new FormData(form);

            fetch("<?php echo e(route('admin.subscriptions.approveCancellation', ['subscription' => 'SUB_ID'])); ?>".replace('SUB_ID', currentSubId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Approved!',
                            'Refund processed and subscription approved.',
                            'success'
                        );
                        $('#refundModal').modal('hide');
                        const row = document.getElementById('sub-row-' + currentSubId);
                        row.querySelector('td:nth-child(5) span').innerText = 'Cancelled';
                        row.querySelector('td:nth-child(5) span').className = 'badge badge-secondary';
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Something went wrong!', 'error');
                });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/subscriptions/cancellation-requests.blade.php ENDPATH**/ ?>
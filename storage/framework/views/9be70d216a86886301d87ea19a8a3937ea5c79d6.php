

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
                                <h4 class="card-title">Orders Cancellation Requests</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="cancel-requests-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Order ID</th>
                                                <th>Buyer Info</th>
                                                <th>Seller Info</th>
                                                <th>Product Detail</th>
                                                <th>Product Cost</th>
                                                <th>Cancel Reason</th>
                                                <th>Requested At</th>
                                                <th>Requested By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $currentStatus = $order->currentStatus ?? 'N/A'; ?>
                                                <tr id="sub-row-<?php echo e($order->id); ?>">
                                                    <td><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i')); ?>

                                                    </td>
                                                    <td><?php echo e($order->order_number); ?></td>
                                                    <!-- Buyer Info -->
                                                    <td>
                                                        ID: <?php echo e($order->customer->customer_id ?? '-'); ?><br>
                                                        <?php echo e($order->customer->first_name ?? '-'); ?>

                                                        <?php echo e($order->customer->last_name ?? '-'); ?><br>
                                                        <?php echo e($order->customer->email ?? '-'); ?>

                                                    </td>

                                                    <!-- Seller Info -->
                                                    <td>
                                                        ID: <?php echo e($order->seller->customer_id ?? '-'); ?><br>
                                                        <?php echo e($order->seller->first_name ?? '-'); ?>

                                                        <?php echo e($order->seller->last_name ?? '-'); ?><br>
                                                        <?php echo e($order->seller->email ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        <span class="product-name"><?php echo e($order->product_title); ?></span><br>
                                                        <small><?php echo e($order->category_name); ?></small><br>
                                                        <?php if($order->product_photo): ?>
                                                            <img src="<?php echo e(asset('storage/' . $order->product_photo)); ?>"
                                                                alt="Product Photo" width="50">
                                                        <?php endif; ?>
                                                    </td>
                                                    <!-- Product Cost -->
                                                    <td><?php echo e($order->total ?? '-'); ?></td>

                                                    <!-- Cancel Reason -->
                                                    <td>
                                                        <?php if($currentStatus): ?>
                                                            <strong><?php echo e($currentStatus->cancellation_reason); ?></strong>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>

                                                     <!-- Requested At -->
        <td>
            <?php if($currentStatus): ?>
                <?php echo e(\Carbon\Carbon::parse($currentStatus->requested_at)->format('Y-m-d H:i')); ?>

            <?php else: ?>
                -
            <?php endif; ?>
        </td>

          <td>
            <?php if($currentStatus): ?>
                <?php 
                    $requestedBy = \App\Models\Customer::find($currentStatus->requested_by); 
                ?>
                <?php echo e($requestedBy->first_name ?? '-'); ?> <?php echo e($requestedBy->last_name ?? '-'); ?><br>
                (ID: <?php echo e($requestedBy->customer_id ?? $currentStatus->requested_by); ?>)
            <?php else: ?>
                -
            <?php endif; ?>
        </td>

                                                    <td>
                                                        <?php if($currentStatus->status === 'cancel_requested'): ?>
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                onclick="openRefundModal(<?php echo e($order->id); ?>)">Approve</button>
                                                            <form
                                                                action="<?php echo e(route('admin.product-orders.rejectCancellation', $order->id)); ?>"
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

            fetch("<?php echo e(route('admin.product-orders.approveCancellation', ['subscription' => 'SUB_ID'])); ?>".replace('SUB_ID', currentSubId), {
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
                            'Refund processed and request approved.',
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/product-orders/cancellation-requests.blade.php ENDPATH**/ ?>
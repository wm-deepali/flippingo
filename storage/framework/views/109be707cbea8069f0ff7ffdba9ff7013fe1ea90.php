<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-inactive">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Seller Info</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Subscription Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($sub->status == 'cancelled'): ?>
                    <div class="modal fade" id="refundModal<?php echo e($sub->id); ?>" tabindex="-1"
                        aria-labelledby="refundModalLabel<?php echo e($sub->id); ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="refundModalLabel<?php echo e($sub->id); ?>">
                                        Refund Details for Order #ORD<?php echo e($sub->id); ?>

                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?php if($sub->refund): ?>
                                        <p><strong>Refund
                                                Method:</strong>
                                            <?php echo e(ucfirst($sub->refund->refund_method)); ?>

                                        </p>
                                        <p><strong>Refund
                                                Amount:</strong>
                                            <?php echo e($sub->refund->amount); ?>

                                        </p>
                                        <?php if($sub->refund->payment_date): ?>
                                            <p><strong>Payment
                                                    Date:</strong>
                                                <?php echo e(\Carbon\Carbon::parse($sub->refund->payment_date)->format('Y-m-d')); ?>

                                            </p>
                                        <?php endif; ?>
                                        <?php if($sub->refund->reference_id): ?>
                                            <p><strong>Reference
                                                    ID:</strong>
                                                <?php echo e($sub->refund->reference_id); ?>

                                            </p>
                                        <?php endif; ?>
                                        <?php if($sub->refund->remarks): ?>
                                            <p><strong>Remarks:</strong>
                                                <?php echo e($sub->refund->remarks); ?>

                                            </p>
                                        <?php endif; ?>
                                        <?php if($sub->refund->screenshot): ?>
                                            <p><strong>Screenshot:</strong>
                                                <a href="<?php echo e(asset('storage/' . $sub->refund->screenshot)); ?>" target="_blank"
                                                    rel="noopener noreferrer">View
                                                    Image</a>
                                            </p>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p>No refund details
                                            available.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i')); ?>

                        </td>
                        <td><?php echo e($sub->order_number); ?></td>
                        <td>
                            Seller ID:
                            <?php echo e($sub->customer->id ?? '-'); ?><br>
                            <?php echo e($sub->customer->first_name ?? '-'); ?>

                            <?php echo e($sub->customer->last_name ?? '-'); ?><br>
                            <?php echo e($sub->customer->email ?? '-'); ?>

                        </td>
                        <td><?php echo e($sub->refund->refund_method === 'source_account' ? $sub->refund->reference_id : '-'); ?>

                        </td>
                        <td><?php echo e(ucfirst($sub->refund->refund_method ?? '-')); ?>

                        </td>
                        <td>
                            <?php if($sub->refund): ?>
                                <span class="badge badge-success">Paid</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Failed</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge badge-danger">Cancelled</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#refundModal<?php echo e($sub->id); ?>">
                                View Refund Detail
                            </button>


                            <a href="<?php echo e(route('admin.subscriptions.show', $sub->id)); ?>"
                                class="btn btn-sm btn-secondary">
                                View Order Detail
                            </a>
                            <a href="<?php echo e(route('admin.customers.view', ['id' => $sub->customer->id])); ?>" target="_blank"
                                class="btn btn-sm btn-info">
                                View Seller Detail
                            </a>
                            <a href="<?php echo e(route('admin.orders.invoice', ['type' => 'subscription', 'id' => $sub->id])); ?>"
                                target="_blank" class="btn btn-sm btn-primary">
                                View Invoice
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/subscriptions/partials/subscription-table-cancelled.blade.php ENDPATH**/ ?>
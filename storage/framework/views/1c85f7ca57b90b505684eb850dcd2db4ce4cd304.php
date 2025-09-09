<div class="table-responsive">
    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Seller Info</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Subscription Status</th>
                <th>Subscription Expiry</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($sub->status === 'active'): ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i')); ?>

                        </td>
                        <td>#ORD<?php echo e($sub->id); ?></td>
                        <td>
                            Seller ID: <?php echo e($sub->customer->id ?? '-'); ?><br>
                            <?php echo e($sub->customer->first_name ?? '-'); ?>

                            <?php echo e($sub->customer->last_name ?? '-'); ?><br>
                            <?php echo e($sub->customer->email ?? '-'); ?>

                        </td>
                        <td><?php echo e($sub->payment->payment_id ?? '-'); ?></td>
                        <td><?php echo e(ucfirst($sub->payment->gateway ?? '-')); ?></td>
                        <td>
                            <?php if($sub->payment->status === 'success'): ?>
                                <span class="badge badge-success">Paid</span>
                            <?php elseif($sub->payment->status === 'pending'): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Failed</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge badge-primary">Active</span></td>
                        <td><?php echo e(\Carbon\Carbon::parse($sub->end_date)->format('Y-m-d')); ?>

                        </td>
                        <td>
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
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/subscriptions/partials/subscription-table.blade.php ENDPATH**/ ?>
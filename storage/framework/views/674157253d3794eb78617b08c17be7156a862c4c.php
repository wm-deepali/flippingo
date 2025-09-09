<div class="table-responsive">
    <table class="table table-bordered" id="payments-table">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order Type</th>
                <th>Order ID</th>
                <th>Invoice Number</th>
                <th>Seller Info</th>
                <th>Buyer Info</th>
                <th>Paid Amount</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // Determine order type. Example: check related models existence or a type field
                    $orderType = $payment->subscription_id ? 'Subscription Order' : 'Product Order';
                    // Seller info and Buyer info based on order type
                    $seller = $orderType == 'Subscription Order' ? $payment->subscription->customer ?? null : $payment->product->seller ?? null;
                    $buyer = $orderType == 'Product Order' ? $payment->product->buyer ?? null : null;
                ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($payment->created_at)->format('Y-m-d H:i')); ?></td>
                    <td><?php echo e($orderType); ?></td>
                    <td>#ORD<?php echo e($orderType == 'Subscription Order' ? ($payment->subscription->id ?? '-') : ($payment->product_order_id ?? '-')); ?></td>
                    <td><?php echo e($payment->invoice_number ?? '-'); ?></td>
                    <td>
                        <?php if($seller): ?>
                            <?php echo e($seller->first_name ?? '-'); ?> <?php echo e($seller->last_name ?? ''); ?><br>
                            <?php echo e($seller->email ?? '-'); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($buyer): ?>
                            <?php echo e($buyer->first_name ?? '-'); ?> <?php echo e($buyer->last_name ?? ''); ?><br>
                            <?php echo e($buyer->email ?? '-'); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?php echo e(number_format($payment->amount, 2)); ?></td>
                    <td><?php echo e(ucfirst($payment->gateway)); ?></td>
                    <td>
                        <?php if($payment->status === 'success'): ?>
                            <span class="badge badge-success">Paid</span>
                        <?php elseif($payment->status === 'pending'): ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php elseif($payment->status === 'cancelled'): ?>
                            <span class="badge badge-danger">Cancelled</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Failed</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.invoices.view', $payment->invoice_number)); ?>" class="btn btn-sm btn-primary" target="_blank">
                            View Invoice
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/order_payments/payments-table.blade.php ENDPATH**/ ?>
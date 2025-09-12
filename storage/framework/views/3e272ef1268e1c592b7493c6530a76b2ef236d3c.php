<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Subscription Name</th>
                <th>Seller Info</th>
                <th>Listing</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($sub->created_at)->format('d M Y H:i')); ?></td>
                    <td>#<?php echo e($sub->order_number); ?></td>
                    <td><?php echo e($sub->package->name ?? 'N/A'); ?></td>
                    <td>
                        Seller ID: <?php echo e($sub->customer->id ?? '-'); ?><br>
                        <?php echo e($sub->customer->first_name ?? '-'); ?>

                        <?php echo e($sub->customer->last_name ?? '-'); ?><br>
                        <?php echo e($sub->customer->email ?? '-'); ?>

                    </td>
                    <td><?php echo e($sub->listings_count ?? 0); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($sub->end_date)->format('d M Y')); ?></td>
                    <td>
                        <?php if($sub->payment->status === 'success'): ?>
                            <span class="badge badge-success">Paid</span>
                        <?php elseif($sub->payment->status === 'pending'): ?>
                            <span class="badge badge-warning">Pending</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Failed</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.subscriptions.show', $sub->id)); ?>" class="btn btn-primary btn-sm">View 
                            Order Details</a>
                        <a href="#" class="btn btn-info btn-sm">View Ads</a>
                        <a href="<?php echo e(route('admin.customers.show', $sub->customer_id)); ?>"
                            class="btn btn-secondary btn-sm">View Seller Details</a>
                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/reports/sub-table.blade.php ENDPATH**/ ?>
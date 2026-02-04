<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Buyer Info</th>
                <th>Seller Info</th>
                <th>Product Cost</th>
                <th>Order Status</th>
          
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $status = $order->currentStatus->status ?? 'N/A'; ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i')); ?></td>
                    <td><?php echo e($order->order_number); ?></td>
                    
                    <!-- Buyer Info -->
                    <td>
                         ID: <?php echo e($order->customer->customer_id ?? '-'); ?><br>
                        <?php echo e($order->customer->first_name ?? '-'); ?> <?php echo e($order->customer->last_name ?? '-'); ?><br>
                        <?php echo e($order->customer->email ?? '-'); ?>

                    </td>

                    <!-- Seller Info -->
                    <td>
                         ID: <?php echo e($order->seller->customer_id ?? '-'); ?><br>
                        <?php echo e($order->seller->first_name ?? '-'); ?> <?php echo e($order->seller->last_name ?? '-'); ?><br>
                        <?php echo e($order->seller->email ?? '-'); ?>

                    </td>

                    <!-- Product Cost -->
                    <td><?php echo e($order->total ?? '-'); ?></td>

                  
                    <!-- Order Status -->
                    <td>
                        <?php switch($status):
                            case ('recent'): ?>
                                <span class="badge badge-primary">Recent</span>
                                <?php break; ?>
                            <?php case ('approved'): ?>
                                <span class="badge badge-secondary">Approved</span>
                                <?php break; ?>
                            <?php case ('processing'): ?>
                                <span class="badge badge-info">Processing</span>
                                <?php break; ?>
                            <?php case ('delivered'): ?>
                                <span class="badge badge-success">Delivered</span>
                                <?php break; ?>
                            <?php case ('cancel_requested'): ?>
                                <span class="badge badge-warning">Cancel Requested</span>
                                <?php break; ?>
                            <?php case ('cancelled'): ?>
                                <span class="badge badge-danger">Cancelled</span>
                                <?php break; ?>
                            <?php default: ?>
                                <span class="badge badge-light"><?php echo e(ucfirst($status)); ?></span>
                        <?php endswitch; ?>
                    </td>

           

                    <!-- Action Buttons -->
                    <td>
                        <a href="<?php echo e(route('admin.product-orders.show', $order->id)); ?>" class="btn btn-sm btn-secondary">
                            View Order Detail
                        </a>

                        <a href="<?php echo e(route('admin.customers.show',$order->customer->id)); ?>" target="_blank" class="btn btn-sm btn-info">
                            View Seller Info
                        </a>

                        <a href="<?php echo e(route('admin.customers.show',  $order->seller_id)); ?>" target="_blank" class="btn btn-sm btn-primary">
                            View Customer Info
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/reports/sale-table.blade.php ENDPATH**/ ?>
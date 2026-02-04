<div class="table-responsive">
    <?php
        $hasDelivered = $orders->contains(fn($o) => optional($o->currentStatus)->status === 'delivered');
        $hasCancelled = $orders->contains(fn($o) => optional($o->currentStatus)->status === 'cancelled');
    ?>

    <table class="table table-bordered" id="orders-table-active">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Buyer Info</th>
                <th>Seller Info</th>
                <th>Product Detail</th>
                <th>Product Cost</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Order Status</th>

                <?php if($hasDelivered): ?>
                    <th>Delivery Date</th>
                    <th>Delivery Method</th>
                <?php endif; ?>

                <?php if($hasCancelled): ?>
                    <th>Cancelled By</th>
                    <th>Cancellation Reason</th>
                    <th>Cancellation Date</th>
                <?php endif; ?>

                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $status = optional($order->currentStatus)->status ?? 'N/A';
                ?>

                <tr>
                    <td><?php echo e($order->created_at->format('Y-m-d H:i')); ?></td>

                    <td><?php echo e($order->order_number); ?></td>

                    
                    <td>
                        ID: <?php echo e($order->customer->customer_id ?? '-'); ?><br>
                        <?php echo e($order->customer->first_name ?? '-'); ?> <?php echo e($order->customer->last_name ?? '-'); ?><br>
                        <?php echo e($order->customer->email ?? '-'); ?>

                    </td>

                    
                    <td>
                        ID: <?php echo e($order->seller->customer_id ?? '-'); ?><br>
                        <?php echo e($order->seller->first_name ?? '-'); ?> <?php echo e($order->seller->last_name ?? '-'); ?><br>
                        <?php echo e($order->seller->email ?? '-'); ?>

                    </td>

                    
                    <td>
                        <span class="product-name"><?php echo e($order->product_title); ?></span><br>
                        <small><?php echo e($order->category_name); ?></small><br>
                        <?php if($order->product_photo): ?>
                            <img src="<?php echo e(asset('storage/'.$order->product_photo)); ?>" width="50">
                        <?php endif; ?>
                    </td>

                    
                    <td>₹<?php echo e(number_format($order->total ?? 0, 2)); ?></td>

                    
                    <td><?php echo e(optional($order->payment)->payment_id ?? '-'); ?></td>

                    
                    <td>
                        <?php echo e(optional($order->payment)->gateway
                            ? ucfirst(optional($order->payment)->gateway)
                            : '-'); ?>

                    </td>

                    
                    <td>
                        <?php switch($status):
                            case ('recent'): ?> <span class="badge badge-primary">Recent</span> <?php break; ?>
                            <?php case ('approved'): ?> <span class="badge badge-secondary">Approved</span> <?php break; ?>
                            <?php case ('processing'): ?> <span class="badge badge-info">Processing</span> <?php break; ?>
                            <?php case ('delivered'): ?> <span class="badge badge-success">Delivered</span> <?php break; ?>
                            <?php case ('cancel_requested'): ?> <span class="badge badge-warning">Cancel Requested</span> <?php break; ?>
                            <?php case ('cancelled'): ?> <span class="badge badge-danger">Cancelled</span> <?php break; ?>
                            <?php default: ?> <span class="badge badge-light"><?php echo e(ucfirst($status)); ?></span>
                        <?php endswitch; ?>
                    </td>

                    
                    <?php if($hasDelivered): ?>
                        <td><?php echo e($status === 'delivered' ? optional($order->currentStatus)->delivery_date : '-'); ?></td>
                        <td><?php echo e($status === 'delivered' ? optional($order->currentStatus)->delivery_method : '-'); ?></td>
                    <?php endif; ?>

                    
                    <?php if($hasCancelled): ?>
                        <td>
                            <?php if($status === 'cancelled'): ?>
                                <?php $cancelledBy = optional($order->currentStatus)->cancelled_by; ?>

                                <?php if($cancelledBy == $order->seller_id): ?>
                                    <?php echo e($order->seller->first_name ?? '-'); ?> <?php echo e($order->seller->last_name ?? ''); ?>

                                <?php else: ?>
                                    <?php echo e(optional(\App\Models\User::find($cancelledBy))->name ?? 'Admin'); ?>

                                <?php endif; ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>

                        <td><?php echo e($status === 'cancelled' ? optional($order->currentStatus)->cancellation_reason : '-'); ?></td>

                        <td>
                            <?php echo e($status === 'cancelled'
                                ? \Carbon\Carbon::parse(
                                    optional($order->currentStatus)->cancelled_at
                                    ?? optional($order->currentStatus)->updated_at
                                  )->format('Y-m-d')
                                : '-'); ?>

                        </td>
                    <?php endif; ?>

                    
                    <td>
                        <a href="<?php echo e(route('admin.product-orders.show', $order->id)); ?>"
                           class="btn btn-sm btn-secondary">View Order</a>

                        <a href="<?php echo e(route('admin.customers.show', $order->seller_id)); ?>"
                           class="btn btn-sm btn-info" target="_blank">Seller</a>

                        <a href="<?php echo e(route('admin.customers.show', $order->customer_id)); ?>"
                           class="btn btn-sm btn-primary" target="_blank">Buyer</a>

                        <a href="<?php echo e(route('admin.product-orders.invoice', $order->id)); ?>"
                           class="btn btn-sm btn-dark" target="_blank">Invoice</a>

                        <button class="btn btn-sm btn-warning changeStatusBtn"
                            data-id="<?php echo e($order->id); ?>"
                            data-status="<?php echo e(optional($order->currentStatus)->status); ?>"
                            data-remarks="<?php echo e(optional($order->currentStatus)->remarks); ?>"
                            data-delivery-date="<?php echo e(optional($order->currentStatus)->delivery_date); ?>"
                            data-delivery-method="<?php echo e(optional($order->currentStatus)->delivery_method); ?>"
                            data-cancellation-reason="<?php echo e(optional($order->currentStatus)->cancellation_reason); ?>">
                            Change Status
                        </button>

                        <button class="btn btn-sm btn-danger deleteOrderBtn"
                            data-id="<?php echo e($order->id); ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php echo e($orders->links()); ?>

<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/product-orders/table.blade.php ENDPATH**/ ?>
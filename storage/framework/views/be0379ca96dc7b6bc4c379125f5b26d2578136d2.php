<div class="table-wrapper">
    <table class="order-table">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Order ID</th>
                <th>Product Detail</th>
                <th>Billed Amount</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $status = $order->currentStatus->status ?? 'N/A'; ?>
                <tr>
                    <td><?php echo e($order->created_at->format('d M Y, h:i A')); ?></td>
                    <td>#<?php echo e($order->order_number); ?></td>
                    <td>
                        <span class="product-name"><?php echo e($order->product_title); ?></span><br>
                        <small><?php echo e($order->category_name); ?></small><br>
                        <?php if($order->product_photo): ?>
                            <img src="<?php echo e(asset('storage/' . $order->product_photo)); ?>" alt="Product Photo" width="50">
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($order->total); ?></td>
                    <td><?php echo e(ucfirst($order->payment->status)); ?></td>
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
                    <td class="actions">
                       <a href="<?php echo e(route('orders.detail', $order->id)); ?>">
    <i class="fas fa-eye" title="View Order Detail"></i>
</a>

<a href="<?php echo e(route('orders.invoice', $order->id)); ?>">
    <i class="fas fa-file-invoice" title="View Payment Detail"></i>
</a>

                          <?php if(in_array($status, ['recent', 'approved', 'processing'])): ?>
                          <a class="action-btn cancel-order-btn" data-order-id="<?php echo e($order->id); ?>">
                                 <i class="fas fa-undo" title="Cancel Order"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/orders/buyer-table.blade.php ENDPATH**/ ?>
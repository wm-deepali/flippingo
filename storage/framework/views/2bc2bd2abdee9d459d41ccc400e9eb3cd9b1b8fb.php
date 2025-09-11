

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
                                    <li class="breadcrumb-item active">All Sales Listing:
                                    </li>
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
                                <h4>All Sales for Submission: <?php echo e($submission->product_title); ?></h4>
                            </div>
                            <div class="card-body">
                                <p>Seller: <?php echo e($submission->customer->first_name ?? ''); ?> <?php echo e($submission->customer->last_name ?? ''); ?></p>
  <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Order ID</th>
                            <th>Buyer Info</th>
                            <th>Paid Amount</th>
                            <th>Payment Method</th>
                            <th>Commission</th>
                            <th>Status</th>
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
                                    Buyer ID: <?php echo e($order->customer->id ?? '-'); ?><br>
                                    <?php echo e($order->customer->first_name ?? '-'); ?> <?php echo e($order->customer->last_name ?? '-'); ?><br>
                                    <?php echo e($order->customer->email ?? '-'); ?>

                                </td>

                                <!-- Product Cost -->
                                <td><?php echo e($order->total ?? '-'); ?></td>

                                <!-- Payment Method -->
                                <td><?php echo e(ucfirst($order->payment->gateway ?? '-')); ?></td>

                                  <td><?php echo e($order->commission_amount ?? '-'); ?></td>

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

                     <td>
                        <a href="<?php echo e(route('admin.product-orders.show', $order->id)); ?>" class="btn btn-sm btn-secondary">
                            View Order Detail
                        </a>

                 
                        <a href="<?php echo e(route('admin.customers.view', ['id' => $order->seller_id])); ?>" target="_blank" class="btn btn-sm btn-primary">
                            View Buyer Info
                        </a>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form_submissions/sales.blade.php ENDPATH**/ ?>
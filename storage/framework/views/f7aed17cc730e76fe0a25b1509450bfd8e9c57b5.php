

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
                                    <li class="breadcrumb-item active">Manage Orders</li>
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
                                <h4 class="card-title">Orders Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="orders-table">
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
                                                <tr>
                                                    <td><?php echo e(\Carbon\Carbon::parse($sub->created_at)->format('Y-m-d H:i')); ?></td>
                                                    <td>#ORD<?php echo e($sub->id); ?></td>
                                                    <td>
                                                        Seller ID: <?php echo e($sub->customer->id ?? '-'); ?><br>
                                                       <?php echo e($sub->customer->first_name ?? '-'); ?> <?php echo e($sub->customer->last_name ?? '-'); ?><br>
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
                                                    <td>
                                                        <?php if($sub->status === 'active'): ?>
                                                            <span class="badge badge-primary">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Inactive</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($sub->end_date)->format('Y-m-d')); ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-secondary">View Order Detail</button>
                                                        <button class="btn btn-sm btn-info">View Seller Detail</button>
                                                        <button class="btn btn-sm btn-primary">Download Invoice</button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/subscriptions/orders.blade.php ENDPATH**/ ?>
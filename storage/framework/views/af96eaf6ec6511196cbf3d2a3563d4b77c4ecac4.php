

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <h4>All Sellers Income Details</h4>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="sellers-income-table">
                                    <thead>
                                        <tr>
                                            <th>Seller ID</th>
                                            <th>Seller Name</th>
                                            <th>Email</th>
                                            <th>Wallet Balance (₹)</th>
                                            <th>Account Type</th>
                                            <th>Total Orders</th>
                                            <th>Total Earnings (₹)</th>
                                            <th>Last Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $lastOrder = $item['orders']->sortByDesc('created_at')->first();
                                            ?>
                                            <tr>
                                                <td><?php echo e($item['seller']->customer_id); ?></td>
                                                <td><?php echo e($item['seller']->display_name ?? $item['seller']->first_name . ' ' . $item['seller']->last_name); ?>

                                                </td>
                                                <td><?php echo e($item['seller']->email); ?></td>
                                                <td>₹<?php echo e(number_format($item['seller']->wallet->balance ?? 0, 2)); ?></td>
                                                <td><?php echo e(ucfirst($item['seller']->account_type ?? 'seller')); ?></td>
                                                <td><?php echo e($item['orders']->count()); ?></td>
                                                <td>₹<?php echo e(number_format($item['total_earnings'], 2)); ?></td>
                                                <td><?php echo e($lastOrder ? $lastOrder->created_at->format('Y-m-d H:i') : '-'); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.seller-orders', $item['seller']->id)); ?>"
                                                        class="btn btn-sm btn-info">
                                                        View Orders
                                                    </a>

                                                    <a href="<?php echo e(route('admin.customers.show', $item['seller']->id)); ?>"
                                                        class="btn btn-sm btn-primary">View Seller Info</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="9" class="text-center">No sellers with submissions found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('#sellers-income-table').DataTable({
                "order": [[0, "desc"]],
                "pageLength": 25
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/customers/all_sellers_income.blade.php ENDPATH**/ ?>
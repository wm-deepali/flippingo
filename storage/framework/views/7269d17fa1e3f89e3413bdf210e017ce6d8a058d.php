

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
                                    <li class="breadcrumb-item active">Wallet Transaction </li>
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
                                <h4>Transactions for <?php echo e($wallet->customer->first_name ?? '-'); ?>

                                    <?php echo e($wallet->customer->last_name ?? ''); ?>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Remarks</th>
                                                <th>Reference ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($tx->created_at->format('Y-m-d H:i')); ?></td>
                                                    <td><?php echo e(ucfirst($tx->type)); ?></td>
                                                    <td><?php echo e(number_format($tx->amount, 2)); ?></td>
                                                    <td><?php echo e(ucfirst($tx->transaction_type)); ?></td>
                                                    <td><?php echo e($tx->remarks ?? '-'); ?></td>
                                                    <td><?php echo e($tx->reference_id ?? '-'); ?></td>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/wallets/transactions.blade.php ENDPATH**/ ?>
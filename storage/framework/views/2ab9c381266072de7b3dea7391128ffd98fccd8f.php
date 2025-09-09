

<?php $__env->startSection('title', 'Manage Order Payments'); ?>

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
                                <li class="breadcrumb-item active">Manage Order Payments</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <h4 class="content-header-title">Order Payments</h4>
            </div>
        </div>

        <div class="content-body">
            <ul class="nav nav-tabs" id="paymentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="successful-tab" data-toggle="tab" data-target="#successful" type="button" role="tab" aria-controls="successful" aria-selected="true">Successful Payments</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="failed-tab" data-toggle="tab" data-target="#failed" type="button" role="tab" aria-controls="failed" aria-selected="false">Failed Payments</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelled-tab" data-toggle="tab" data-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled Payments</button>
                </li>
            </ul>

            <div class="tab-content pt-2" id="paymentTabsContent">
                <!-- Successful Payments -->
                <div class="tab-pane fade show active" id="successful" role="tabpanel" aria-labelledby="successful-tab">
                    <?php echo $__env->make('admin.order_payments.payments-table', ['payments' => $payments->where('status', 'success')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- Failed Payments -->
                <div class="tab-pane fade" id="failed" role="tabpanel" aria-labelledby="failed-tab">
                    <?php echo $__env->make('admin.order_payments.payments-table', ['payments' => $payments->where('status', 'failed')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!-- Cancelled Payments -->
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <?php echo $__env->make('admin.order_payments.payments-table', ['payments' => $payments->where('status', 'cancelled')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/order_payments/index.blade.php ENDPATH**/ ?>
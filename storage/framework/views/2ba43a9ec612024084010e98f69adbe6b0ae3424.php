

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
                                    <li class="breadcrumb-item active">Commission list</li>
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
                                <h4 class="card-title">Commission Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Seller</th>
                                                <th>Email</th>
                                                <th>Total Listings</th>
                                                <th>Commission (%)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    // Find commission record if exists
                                                    $commission = $commissions->firstWhere('seller_id', $seller->id);
                                                  ?>
                                                <tr>
                                                    <td><?php echo e($index + 1); ?></td>
                                                    <td><?php echo e($seller->display_name ?? $seller->first_name); ?></td>
                                                    <td><?php echo e($seller->email); ?></td>
                                                    <td><?php echo e($seller->listing_count); ?></td>
                                                    <td>
                                                        <?php echo e($commission ? $commission->commission_rate . '%' : setting('default_commission', 0) . '%'); ?>

                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#setCommissionModal<?php echo e($seller->id); ?>">
                                                            Set / Update
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="setCommissionModal<?php echo e($seller->id); ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Set Commission for
                                                                    <?php echo e($seller->display_name ?? $seller->first_name); ?></h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form method="POST" action="<?php echo e(route('admin.commissions.store')); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="seller_id"
                                                                        value="<?php echo e($seller->id); ?>">
                                                                    <div class="mb-3">
                                                                        <label>Commission Percentage</label>
                                                                        <input type="number" step="0.01" name="commission_rate"
                                                                            class="form-control"
                                                                            value="<?php echo e($commission ? $commission->commission_rate : setting('default_commission', 0)); ?>"
                                                                            required>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/customers/commission.blade.php ENDPATH**/ ?>
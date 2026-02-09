

<?php $__env->startSection('content'); ?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Seller Enquiries</li>
                    </ol>
                </div>
            </div>
        </div>

        
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Seller Enquiries</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Enquiry ID</th>
                                    <th>Buyer Info</th>
                                    <th>Seller Info</th>
                                    <th>Message</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <?php echo e($enquiry->created_at->format('d M Y, H:i')); ?>

                                        </td>

                                        <td>
                                            #<?php echo e($enquiry->id); ?>

                                        </td>

                                        
                                        <td>
                                            <strong><?php echo e($enquiry->name); ?></strong><br>
                                            <?php echo e($enquiry->email); ?><br>
                                            <?php echo e($enquiry->mobile); ?>

                                        </td>

                                        
                                        <td>
                                            <?php if($enquiry->seller): ?>
                                                <strong><?php echo e($enquiry->seller->first_name ?? ''); ?>

                                                    <?php echo e($enquiry->seller->last_name ?? ''); ?></strong><br>
                                                <?php echo e($enquiry->seller->email ?? '-'); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo e(\Illuminate\Support\Str::limit($enquiry->message, 120)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No enquiries found.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <?php echo e($enquiries->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/seller-profile/enquiries.blade.php ENDPATH**/ ?>


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
                        <li class="breadcrumb-item active">Seller Feedback</li>
                    </ol>
                </div>
            </div>
        </div>

        
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Seller Feedback</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Feedback ID</th>
                                    <th>Customer Info</th>
                                    <th>Seller Info</th>
                                    <th>Rating</th>
                                    <th>Message</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <?php echo e($feedback->created_at->format('d M Y, H:i')); ?>

                                        </td>

                                        <td>
                                            #<?php echo e($feedback->id); ?>

                                        </td>

                                        
                                        <td>
                                            <?php if($feedback->customer): ?>
                                                <strong>
                                                    <?php echo e($feedback->customer->first_name ?? ''); ?>

                                                    <?php echo e($feedback->customer->last_name ?? ''); ?>

                                                </strong><br>
                                                <?php echo e($feedback->customer->email ?? '-'); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        
                                        <td>
                                            <?php if($feedback->seller): ?>
                                                <strong>
                                                    <?php echo e($feedback->seller->first_name ?? ''); ?>

                                                    <?php echo e($feedback->seller->last_name ?? ''); ?>

                                                </strong><br>
                                                <?php echo e($feedback->seller->email ?? '-'); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>

                                        
                                        <td>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($i <= $feedback->rating): ?>
                                                    <i class="fas fa-star text-warning"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star text-muted"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <br>
                                            <small>(<?php echo e($feedback->rating); ?>/5)</small>
                                        </td>

                                        
                                        <td>
                                            <?php echo e(\Illuminate\Support\Str::limit($feedback->message, 120)); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No feedback found.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <?php echo e($feedbacks->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/seller-profile/feedback.blade.php ENDPATH**/ ?>
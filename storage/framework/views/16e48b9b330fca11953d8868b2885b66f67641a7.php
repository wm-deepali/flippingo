

<?php $__env->startSection('title', 'Profile Feedback'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-wrapper">
    <div class="container-fluid">

        <h3 class="mb-4">Seller Profile Feedback</h3>

        <div class="card">
            <div class="card-body">

                <?php if($feedbacks->count()): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td>
                                            <?php echo e($feedback->customer->first_name ?? 'Anonymous'); ?>

                                        </td>
                                        <td style="color:#f5c518;font-size:16px;">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php echo $i <= $feedback->rating ? '★' : '☆'; ?>

                                            <?php endfor; ?>
                                        </td>
                                        <td style="max-width:350px;">
                                            <?php echo e(Str::limit($feedback->message, 100)); ?>

                                        </td>
                                        <td><?php echo e($feedback->created_at->format('d M Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center mb-0">No feedback received yet.</p>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/seller/profile-feedback.blade.php ENDPATH**/ ?>
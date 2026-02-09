

<?php $__env->startSection('title', 'My Profile Feedback'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-wrapper">
    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-12">
                <h3 class="page-title">My Seller Profile Feedback</h3>
                <p class="text-muted">Feedback you submitted on seller profiles</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Seller</th>
                                <th>Rating</th>
                                <th>Feedback</th>
                                <th>Submitted On</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>

                                    <td>
                                        <strong>
                                            <?php echo e($feedback->seller->legal_name
                                                ?? trim($feedback->seller->first_name . ' ' . $feedback->seller->last_name)); ?>

                                        </strong>
                                    </td>

                                    <td style="color:#f5c518;font-size:16px;">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php echo $i <= $feedback->rating ? '★' : '☆'; ?>

                                        <?php endfor; ?>
                                    </td>

                                    <td style="max-width:300px;">
                                        <?php echo e(\Illuminate\Support\Str::limit($feedback->message, 80)); ?>

                                    </td>

                                    <td>
                                        <?php echo e($feedback->created_at->format('d M Y')); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        You haven’t submitted any feedback yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <footer class="footer text-center text-muted">
        All Rights Reserved.
    </footer>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/buyer/profile-feedback.blade.php ENDPATH**/ ?>
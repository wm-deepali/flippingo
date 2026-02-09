

<?php $__env->startSection('title', 'Profile Enquiries'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page-wrapper">
    <div class="container-fluid">

        <h3 class="mb-4">Seller Profile Enquiries</h3>

        <div class="card">
            <div class="card-body">

                <?php if($enquiries->count()): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e($enquiry->name); ?></td>
                                        <td><?php echo e($enquiry->email); ?></td>
                                        <td><?php echo e($enquiry->mobile ?? '-'); ?></td>
                                        <td style="max-width:300px;">
                                            <?php echo e(Str::limit($enquiry->message, 80)); ?>

                                        </td>
                                        <td><?php echo e($enquiry->created_at->format('d M Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center mb-0">No profile enquiries received yet.</p>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/seller/profile-enquiries.blade.php ENDPATH**/ ?>
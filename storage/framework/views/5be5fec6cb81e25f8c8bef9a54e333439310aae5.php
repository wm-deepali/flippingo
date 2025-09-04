

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
                                    <li class="breadcrumb-item active">Enquiries</li>
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
                                <h4 class="card-title">Enquiries</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="enquiries-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Submission ID</th>
                                                <th>Customer (Enquirer)</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $enquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($enquiry->id); ?></td>
                                                    <td>
                                                        <a
                                                            href="<?php echo e(route('admin.form-submissions.show', $enquiry->submission->id ?? '#')); ?>">
                                                            <?php echo e($enquiry->submission_id); ?>

                                                        </a>
                                                    </td>
                                                    <td><?php echo e($enquiry->customer->first_name); ?>

                                                        <?php echo e($enquiry->customer->last_name); ?>

                                                    </td>
                                                    <td><?php echo e(Str::limit($enquiry->message, 100)); ?></td>
                                                    <td>
                                                        <?php if($enquiry->status == 'pending'): ?>
                                                            <span class="badge badge-warning">Pending</span>
                                                        <?php elseif($enquiry->status == 'completed'): ?>
                                                            <span class="badge badge-success">Completed</span>
                                                        <?php else: ?>
                                                            <span
                                                                class="badge badge-secondary"><?php echo e(ucfirst($enquiry->status)); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($enquiry->created_at->format('d M Y H:i')); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No enquiries found.</td>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/enquiry/index.blade.php ENDPATH**/ ?>
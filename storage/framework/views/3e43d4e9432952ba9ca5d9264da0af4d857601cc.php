

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Listing Details'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="listing-and-product">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">Listing Details</h3>
                <a href="<?php echo e(route('dashboard.listing')); ?>" class="btn btn-sm btn-secondary">
                    ← Back to Listings
                </a>
            </div>

            <!-- Basic Information -->
            <div class="card">
                <div class="card-header">
                    <h4>Basic Information</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Form</dt>
                        <dd class="col-sm-9"><?php echo e($submission->form->name ?? 'N/A'); ?></dd>

                        <dt class="col-sm-3">Submitted By</dt>
                        <dd class="col-sm-9"><?php echo e($submission->customer->first_name ?? ' '); ?>

                            <?php echo e($submission->customer->last_name ?? ''); ?>

                        </dd>

                        <dt class="col-sm-3">Submitted On</dt>
                        <dd class="col-sm-9"><?php echo e($submission->created_at->format('d M Y H:i')); ?></dd>

                        <dt class="col-sm-3">Status</dt>
                       <dd class="col-sm-9">
                          <?php switch($submission->status):
                            case ('pending'): ?>
                                <span class="badge badge-secondary">Recent</span>
                                <?php break; ?>
                            <?php case ('published'): ?>
                                <span class="badge badge-success">Published</span>
                                <?php break; ?>
                            <?php case ('expired'): ?>
                                <span class="badge badge-warning">Expired</span>
                                <?php break; ?>
                            <?php case ('rejected'): ?>
                                <span class="badge badge-danger">Rejected</span>
                                <?php break; ?>
                            <?php default: ?>
                                <span class="badge badge-light"><?php echo e(ucfirst($submission->status)); ?></span>
                        <?php endswitch; ?>
                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Submission Data -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Submission Data</h4>
                </div>
              <div class="card-body">
        <?php if(!empty($mappedData)): ?>
            <dl class="row">
                <?php $__currentLoopData = $mappedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php
    $val = $data['value'] ?? '';
    if (!empty($data['child_value'])) {
        $val .= ' → ' . $data['child_value'];
    }
     // If "Other" is chosen and a custom value exists
    if (($data['value'] ?? '') === 'Other' && !empty($data['child_custom_value'])) {
        $val .= ' → ' . $data['child_custom_value'];
    }
?>
                    <dt class="col-sm-4"><?php echo e($label); ?> :</dt>
                    <dd class="col-sm-8">
                        <?php if(is_array($val) || is_object($val)): ?>
                            <pre><?php echo e(json_encode($val, JSON_PRETTY_PRINT)); ?></pre>
                        <?php else: ?>
                            <?php echo e($val); ?>

                        <?php endif; ?>
                    </dd>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </dl>
        <?php else: ?>
            <p>No submission data available.</p>
        <?php endif; ?>
    </div>
            </div>

            <!-- Files Section -->
            <?php if($submission->files->count() > 0): ?>
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Uploaded Files</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Field Name</th>
                                    <th>Original File Name</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $submission->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($file->field_name ?? '-'); ?></td>
                                        <td><?php echo e($file->original_name ?? 'Unnamed'); ?></td>
                                        <td>
                                            <a href="<?php echo e(asset('storage/' . $file->file_path)); ?>" target="_blank"
                                                class="btn btn-sm btn-primary">
                                                View File
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/listing/show.blade.php ENDPATH**/ ?>
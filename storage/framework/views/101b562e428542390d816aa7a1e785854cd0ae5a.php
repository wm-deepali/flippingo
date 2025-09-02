

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
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.form-submissions.index')); ?>">Form
                                            Submissions</a></li>
                                    <li class="breadcrumb-item active">View Form Submission Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <a href="<?php echo e(route('admin.form-submissions.index')); ?>" class="btn btn-primary btn-sm">Back to List</a>
                </div>
            </div>


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

                        <dt class="col-sm-3">Published</dt>
                        <dd class="col-sm-9">
                            <?php if($submission->published): ?>
                                <span class="badge badge-success">Yes</span>
                                <br>
                                <small>On
                                    <?php echo e($submission->published_at ? $submission->published_at->format('d M Y H:i') : '-'); ?></small>
                            <?php else: ?>
                                <span class="badge badge-secondary">No</span>
                            <?php endif; ?>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Submission Data</h4>
                </div>
                <div class="card-body">
                    <?php if(!empty($mappedData)): ?>
                        <dl class="row">
                            <?php $__currentLoopData = $mappedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <dt class="col-sm-4"><?php echo e($label); ?> :</dt>
                                <?php $val = $data['value'] ?? $data; ?>
                                <dd class="col-sm-8">
                                    <?php if(is_array($val) || is_object($val)): ?>
                                        <pre><?php echo e(json_encode($val, JSON_PRETTY_PRINT)); ?></pre>
                                    <?php else: ?>
                                        <?php echo e($val); ?>

                                    <?php endif; ?>
                                    <?php if(!empty($data['show_on_summary'])): ?>
                                    (<span class="ms-2">Shown in summary</span>)
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form_submissions/show.blade.php ENDPATH**/ ?>
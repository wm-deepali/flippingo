

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
                                    <li class="breadcrumb-item active">Form Submissions</li>
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
                                <h4 class="card-title">Form Submissions Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="submissions-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Form</th>
                                                <th>Submitted By</th>
                                                <!-- <th>Data Summary</th> -->
                                                <th>Submitted At</th>
                                                <th>Published?</th>
                                                <th>Published At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                            <tr>
                                                                                <td><?php echo e($submission->id); ?></td>
                                                                                <td><?php echo e($submission->form->name ?? '-'); ?></td>
                                                                                <td><?php echo e($submission->customer->first_name ?? '-'); ?>

                                                                                    <?php echo e($submission->customer->last_name ?? ''); ?></td>
                                                                                <!-- <td>
                                                                                    <pre style="max-height:80px; max-width: 300px; overflow:auto;">
                                                    <?php echo e(Str::limit(json_encode(json_decode($submission->data), JSON_PRETTY_PRINT), 150)); ?>

                                                </pre>
                                                                                </td> -->
                                                                                <td><?php echo e($submission->created_at->format('d M Y H:i')); ?></td>
                                                                                <td>
                                                                                    <?php if($submission->published): ?>
                                                                                        <span class="badge badge-success">Published</span>
                                                                                    <?php else: ?>
                                                                                        <span class="badge badge-secondary">Not Published</span>
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo e($submission->published_at ? $submission->published_at->format('d M Y H:i') : '-'); ?>

                                                                                </td>
                                                                                <td>
                                                                                    <!-- Your existing buttons -->
                                                                                    <a href="<?php echo e(route('admin.form-submissions.show', $submission->id)); ?>"
                                                                                        class="btn btn-info btn-sm">
                                                                                        <i class="fas fa-eye"></i> View
                                                                                    </a>
                                                                                    <?php if(!$submission->published): ?>
                                                                                        <button class="btn btn-success btn-sm"
                                                                                            onclick="publishSubmission(<?php echo e($submission->id); ?>)">
                                                                                            <i class="fas fa-upload"></i> Publish
                                                                                        </button>
                                                                                    <?php else: ?>
                                                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                                                            <i class="fas fa-check"></i> Published
                                                                                        </button>
                                                                                    <?php endif; ?>
                                                                                </td>
                                                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">No submissions found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>

                                    <?php echo e($submissions->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        function publishSubmission(id) {
            Swal.fire({
                title: "Publish Submission?",
                text: "Are you sure you want to publish this submission?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, Publish",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/form-submissions/${id}/publish`,
                        type: 'POST',
                        data: {},
                        success: function (response) {
                            Swal.fire("Published!", "The submission has been published.", "success");
                            setTimeout(() => location.reload(), 800);
                        },
                        error: function () {
                            Swal.fire("Error!", "Publishing failed. Try again later.", "error");
                        }
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form_submissions/index.blade.php ENDPATH**/ ?>
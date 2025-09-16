

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Edit Products'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="listing-and-product">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit Listing</h4>
                            <a href="<?php echo e(route('dashboard.listing')); ?>" class="btn btn-secondary btn-sm">
                                ← Back to Listings
                            </a>
                        </div>

                        <div class="card-body">
                            <form id="edit-submission-form" enctype="multipart/form-data"
                                data-action="<?php echo e(route('listing.update', $submission->id)); ?>"><?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                <?php
                    $inputTypes = ['text', 'email', 'number', 'select', 'dropdown', 'file', 'signature', 'textarea', 'date', 'checkbox', 'radio']; // Add all form input types you support
                ?>

                                <?php $__currentLoopData = $formData->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($field['type'], $inputTypes)): ?>
                                        <?php
                                            $fieldKey = $field['properties']['id'] ?? $field['id'];
                                            $type = $field['type'];
                                            $label = $field['properties']['label'] ?? $fieldKey;
                                            $icon = $field['properties']['icon'] ?? '';
                                            $multiple = $field['properties']['multiple'] ?? false;
                                            $value = $existingData[$fieldKey]['value'] ?? '';
                                        ?>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                <?php if($icon): ?><i class="<?php echo e($icon); ?>"></i><?php endif; ?>
                                                <?php echo e($label); ?>

                                            </label>

                                            
                                            <?php if($type === 'file'): ?>
                                                <input type="file" name="<?php echo e($multiple ? $fieldKey . '[]' : $fieldKey); ?>"
                                                    class="form-control" <?php if($multiple): ?> multiple <?php endif; ?>>
                                                <?php $__currentLoopData = $uploadedFiles->where('field_id', $fieldKey); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="mt-2 d-flex align-items-center gap-3">
                                                        
                                                        <?php if(str_starts_with($file->mime_type, 'image/')): ?>
                                                            <img src="<?php echo e(asset('storage/' . $file->file_path)); ?>"
                                                                alt="<?php echo e($file->original_name); ?>"
                                                                style="max-height: 80px; border: 1px solid #ddd; padding: 2px;">
                                                            
                                                        <?php elseif(str_starts_with($file->mime_type, 'video/')): ?>
                                                            <video width="120" height="80" controls>
                                                                <source src="<?php echo e(asset('storage/' . $file->file_path)); ?>"
                                                                    type="<?php echo e($file->mime_type); ?>">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php else: ?>
                                                            
                                                            <i class="bi bi-file-earmark-fill"></i> <?php echo e($file->original_name); ?>

                                                        <?php endif; ?>


                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php elseif($type === 'signature'): ?>
                                                <canvas id="signature_<?php echo e($fieldKey); ?>" width="300" height="100"
                                                    style="border:1px solid #ccc;"></canvas>
                                                <input type="hidden" name="<?php echo e($fieldKey); ?>" id="hidden_signature_<?php echo e($fieldKey); ?>"
                                                    value="<?php echo e($value); ?>">
                                                <button type="button" class="btn btn-secondary btn-sm mt-1"
                                                    id="clear_signature_<?php echo e($fieldKey); ?>">Clear</button>
                                            <?php elseif(in_array($type, ['select', 'dropdown'])): ?>
                                                <select name="<?php echo e($fieldKey); ?>" class="form-control">
                                                    <?php $__currentLoopData = $field['properties']['options'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($optionValue); ?>" <?php if($optionValue == $value): ?> selected <?php endif; ?>>
                                                            <?php echo e($optionLabel); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php else: ?>
                                                <input type="<?php echo e($type); ?>" name="<?php echo e($fieldKey); ?>" value="<?php echo e($value); ?>"
                                                    class="form-control">
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <button type="submit" class="btn btn-primary">Update Submission</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>


        $(document).ready(function () {
            $('#edit-submission-form').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                let url = form.data('action'); // use data-action instead of action
                let formData = new FormData(this);

                // Disable button & show loader
                let submitBtn = form.find('button[type="submit"]');
                submitBtn.prop('disabled', true).text('Updating...');

                $.ajax({
                    url: url,
                    method: 'POST', // Laravel PUT spoofing (_method=PUT) already included
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message || 'Submission updated successfully.',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Redirect after short delay
                            setTimeout(() => {
                                window.location.href = "<?php echo e(route('dashboard.listing')); ?>";
                            }, 1600);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message || 'Something went wrong.'
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            // Validation errors
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = Object.values(errors).map(errArr => errArr[0]).join('<br>');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMessages
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Please try again later.'
                            });
                        }
                    },
                    complete: function () {
                        submitBtn.prop('disabled', false).text('Update Submission');
                    }
                });
            });
        });
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/listing/edit.blade.php ENDPATH**/ ?>
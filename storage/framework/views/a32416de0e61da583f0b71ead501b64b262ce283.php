

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
                                    <li class="breadcrumb-item active">Account Deletion Reasons</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-reason">Add New
                            Reason</a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Account Deletion Reasons Listing</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="reason-table">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Reason</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($reason->created_at->format('Y-m-d H:i')); ?></td>
                                                    <td><?php echo e($reason->reason); ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-reason"
                                                            data-id="<?php echo e($reason->id); ?>">Edit</a>
                                                        <button class="btn btn-danger btn-sm delete-btn"
                                                            data-id="<?php echo e($reason->id); ?>">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No Reasons found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reason-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script>
        $(document).on('click', '.delete-btn', function () {
            const reasonId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This reason will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/deletion_reasons/' + reasonId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire('Deleted!', response.message, 'success');
                            location.reload();
                        },
                        error: function () {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });

        $(document).ready(function () {

            // open create modal
            $(document).on('click', '#add-reason', function () {
                $.ajax({
                    url: "<?php echo e(route('admin.deletion_reasons.create')); ?>",
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                            $("#reason-modal").html(result.html).modal('show');
                        }
                    }
                });
            });

            // add reason
            $(document).on("click", "#add-reason-btn", function () {
                console.log('here');
                
                $(this).attr('disabled', true);
                $('.validation-err').html('');

                const form = $('#add-reason-form')[0];
                const formData = new FormData(form);

                $.ajax({
                    url: "<?php echo e(route('admin.deletion_reasons.store')); ?>",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,
                    context: this,
                    success: function (result) {
                        if (result.success) {
                            Swal.fire('Created!', '', 'success');
                            setTimeout(() => location.reload(), 400);
                        } else {
                            $(this).attr('disabled', false);
                            if (result.code === 422) {
                                for (const key in result.errors) {
                                    $(`#${key}-err`).html(result.errors[key][0]);
                                }
                            } else {
                                console.log(result.msgText);
                            }
                        }
                    }
                });
            });

            // open edit modal
            $(document).on("click", ".edit-reason", function () {
                const id = $(this).data('id');
                $.ajax({
                    url: `/admin/deletion_reasons/${id}/edit`,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                            $("#reason-modal").html(result.html).modal('show');
                        } else {
                            console.log(result.msgText);
                        }
                    }
                });
            });

            // update reason
            $(document).on("click", "#update-reason-btn", function () {
                $(this).attr('disabled', true);
                $('.validation-err').html('');

                const form = $('#edit-reason-form')[0];
                const formData = new FormData(form);
                formData.append('_method', 'PUT');
                const id = $(this).data('reason-id');

                $.ajax({
                    url: `/admin/deletion_reasons/${id}`,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,
                    context: this,
                    success: function (result) {
                        if (result.success) {
                            Swal.fire('Updated!', '', 'success');
                            setTimeout(() => location.reload(), 400);
                        } else {
                            $(this).attr('disabled', false);
                            if (result.code === 422) {
                                for (const key in result.errors) {
                                    $(`#${key}-err`).html(result.errors[key][0]);
                                }
                            } else {
                                console.log(result.msgText);
                            }
                        }
                    }
                });
            });

        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/deletion_reasons/index.blade.php ENDPATH**/ ?>
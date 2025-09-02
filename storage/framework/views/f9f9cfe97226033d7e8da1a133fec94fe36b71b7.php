

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
                                    <li class="breadcrumb-item active">Form Templates</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="<?php echo e(route('admin.form-templates.create')); ?>" class="btn btn-primary btn-round btn-sm">
                            <i class="fas fa-plus"></i> Create New Template
                        </a>
                    </div>
                </div>

            </div>

            
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title">Form Templates</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="template-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Template Name</th>
                                                <th>Slug</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($template->name); ?></td>
                                                    <td><?php echo e($template->slug); ?></td>
                                                    <td><?php echo e($template->created_at->format('d M Y, h:i A')); ?></td>
                                                    <td><?php echo e($template->updated_at->format('d M Y, h:i A')); ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                                id="actionMenu<?php echo e($template->id); ?>" data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="actionMenu<?php echo e($template->id); ?>">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('admin.form-templates.edit', $template->id)); ?>">
                                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('admin.form.create-from-template', $template->id)); ?>">
                                                                        <i class="fas fa-plus-circle"></i> Create Form
                                                                    </a>
                                                                </li>
                                                                <!-- <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        onclick="deleteTemplateConfirmation(<?php echo e($template->id); ?>)">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </a>
                                                                </li> -->
                                                            </ul>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No templates found.</td>
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

    
    <?php $__env->startPush('scripts'); ?>
        <script>
            $(document).ready(function () {
                $('#template-table').DataTable();
            });

            function deleteTemplateConfirmation(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This template will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `<?php echo e(url('admin/form-templates')); ?>/${id}`,
                            type: "DELETE",
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', response.message, 'success');
                                    setTimeout(() => location.reload(), 500);
                                } else {
                                    Swal.fire('Error', response.message || 'Something went wrong', 'error');
                                }
                            }
                        });
                    }
                });
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form_templates/index.blade.php ENDPATH**/ ?>


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
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.form.index')); ?>">Forms</a></li>
                                    <li class="breadcrumb-item active">Manage Filters</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Available Fields</h4>
                            </div>
                            <div class="card-body">
                                <ul id="available-fields" class="list-group">
                                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-key="<?php echo e($f['id']); ?>" data-type="<?php echo e($f['type']); ?>">
                                            <?php echo e($f['label']); ?>

                                            <span class="text-muted">(<?php echo e($f['type']); ?>)</span>
                                            <button class="btn btn-sm btn-success add-filter">+</button>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Selected Filters</h4>
                            </div>
                            <div class="card-body">
                                <form id="filters-form">
                                    <?php echo csrf_field(); ?>
                                    <ul id="selected-filters" class="list-group mb-3">
                                        <?php $__currentLoopData = $savedFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                data-key="<?php echo e($filter->field_key); ?>">
                                                <?php echo e($filter->label); ?>

                                                <span class="text-muted">(<?php echo e($filter->type); ?>)</span>
                                                <input type="hidden" name="filters[]" value="<?php echo e($filter->field_key); ?>">
                                                <button class="btn btn-sm btn-danger remove-filter">x</button>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <button type="submit" class="btn btn-primary">Save Filters</button>
                                    <a href="<?php echo e(route('admin.form.index')); ?>" class="btn btn-outline-secondary">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <style>
        .ui-state-highlight {
            height: 40px;
            background: #f0f0f0;
            border: 1px dashed #ccc;
        }
    </style>

    <script>
        $(function () {
            // Enable drag-and-drop sorting on selected filters
            $("#selected-filters").sortable({
                placeholder: "ui-state-highlight"
            });
            $("#selected-filters").disableSelection();
        });

        // Add filter from available to selected
        $(document).on('click', '.add-filter', function () {
            let li = $(this).closest('li').clone();
            li.find('button')
                .removeClass('btn-success add-filter')
                .addClass('btn-danger remove-filter')
                .text('x');
            li.append('<input type="hidden" name="filters[]" value="' + li.data('key') + '">');
            $('#selected-filters').append(li);
        });

        // Remove from selected
        $(document).on('click', '.remove-filter', function () {
            $(this).closest('li').remove();
        });

        // Save filters with their order
        $('#filters-form').on('submit', function (e) {
            e.preventDefault();

            // rebuild filters array in drag-drop order
            let filters = [];
            $('#selected-filters li').each(function(){
                filters.push($(this).data('key'));
            });

            $.post("<?php echo e(route('admin.form.filter.store', $form->id)); ?>", {
                _token: $('meta[name="csrf-token"]').attr('content'),
                filters: filters
            }, function (res) {
                if (res.success) {
                    Swal.fire('Filters Saved!', '', 'success');
                     window.location.href = "<?php echo e(route('admin.form.index')); ?>";
                } else {
                    Swal.fire('Something went wrong!', '', 'error');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/filter-create.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="content-wrapper">

            
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.form.index')); ?>">Forms</a></li>
                        <li class="breadcrumb-item active">Summary Card Customization</li>
                    </ol>
                </div>
            </div>

            
            <div class="content-body">
                <div class="row">

                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Available Fields</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-key="<?php echo e($field['id']); ?>" data-label="<?php echo e($field['label']); ?>">
                                            <span>
                                                <strong><?php echo e($field['label']); ?></strong>
                                                <small class="text-muted">(<?php echo e($field['type']); ?>)</small>
                                            </span>
                                            <button class="btn btn-sm btn-success add-summary-field">+</button>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Summary Card Fields</h4>
                            </div>

                            <div class="card-body">
                                <form id="summary-card-form">
                                    <?php echo csrf_field(); ?>

                                    <ul id="selected-summary-fields" class="list-group mb-3">
                                        <?php $__currentLoopData = $savedCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item d-flex align-items-center"
                                                data-key="<?php echo e($card->field_key); ?>" data-label="<?php echo e($card->label); ?>">

                                                <input type="text" class="form-control mr-2 icon-input"
                                                    value="<?php echo e($card->icon); ?>" placeholder="fa fa-user" style="max-width:130px;">

                                                <input type="color" class="form-control mr-2 color-input"
                                                    value="<?php echo e($card->color ?? '#000000'); ?>" style="width:55px;padding:2px;">

                                                <span class="icon-preview mr-3">
                                                    <i class="<?php echo e($card->icon); ?>"
                                                        style="color: <?php echo e($card->color ?? '#000000'); ?>"></i>
                                                </span>

                                                <span class="flex-grow-1"><?php echo e($card->label); ?></span>

                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-summary-field">×</button>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                    
                                    <div class="border rounded p-2 mb-3">
                                        <small class="text-muted">Click an icon to use:</small>

                                        <div class="icon-picker mt-2">

                                            <!-- PERSON / CONTACT -->
                                            <i class="fa fa-user" data-icon="fa fa-user" title="Name"></i>
                                            <i class="fa fa-users" data-icon="fa fa-users" title="Users"></i>
                                            <i class="fa fa-id-card" data-icon="fa fa-id-card" title="ID"></i>

                                            <!-- COMMUNICATION -->
                                            <i class="fa fa-envelope" data-icon="fa fa-envelope" title="Email"></i>
                                            <i class="fa fa-phone" data-icon="fa fa-phone" title="Phone"></i>
                                            <i class="fa fa-comment" data-icon="fa fa-comment" title="Message"></i>
                                            <i class="fa fa-comments" data-icon="fa fa-comments" title="Chat"></i>

                                            <!-- LOCATION -->
                                            <i class="fa fa-map-marker-alt" data-icon="fa fa-map-marker-alt"
                                                title="Location"></i>
                                            <i class="fa fa-map" data-icon="fa fa-map" title="Map"></i>
                                            <i class="fa fa-globe" data-icon="fa fa-globe" title="Country"></i>

                                            <!-- DATE / TIME -->
                                            <i class="fa fa-calendar" data-icon="fa fa-calendar" title="Date"></i>

                                            <!-- MONEY / PAYMENT -->
                                            <i class="fa fa-rupee-sign" data-icon="fa fa-rupee-sign" title="Amount (₹)"></i>
                                            <i class="fa fa-dollar-sign" data-icon="fa fa-dollar-sign"
                                                title="Amount ($)"></i>
                                            <i class="fa fa-credit-card" data-icon="fa fa-credit-card" title="Card"></i>
                                            <i class="fa fa-wallet" data-icon="fa fa-wallet" title="Wallet"></i>

                                            <!-- STATUS / ACTION -->
                                            <i class="fa fa-check-circle" data-icon="fa fa-check-circle"
                                                title="Success"></i>
                                            <i class="fa fa-times-circle" data-icon="fa fa-times-circle" title="Failed"></i>
                                            <i class="fa fa-exclamation-circle" data-icon="fa fa-exclamation-circle"
                                                title="Alert"></i>
                                            <i class="fa fa-info-circle" data-icon="fa fa-info-circle" title="Info"></i>

                                            <!-- BUSINESS -->
                                            <i class="fa fa-building" data-icon="fa fa-building" title="Company"></i>
                                            <i class="fa fa-briefcase" data-icon="fa fa-briefcase" title="Work"></i>
                                            <i class="fa fa-store" data-icon="fa fa-store" title="Store"></i>

                                            <!-- FILE / DATA -->
                                            <i class="fa fa-file" data-icon="fa fa-file" title="File"></i>
                                            <i class="fa fa-file-alt" data-icon="fa fa-file-alt" title="Document"></i>
                                            <i class="fa fa-download" data-icon="fa fa-download" title="Download"></i>
                                            <i class="fa fa-upload" data-icon="fa fa-upload" title="Upload"></i>

                                            <!-- MISC -->
                                            <i class="fa fa-star" data-icon="fa fa-star" title="Rating"></i>
                                            <i class="fa fa-heart" data-icon="fa fa-heart" title="Favorite"></i>
                                            <i class="fa fa-tag" data-icon="fa fa-tag" title="Tag"></i>
                                            <i class="fa fa-link" data-icon="fa fa-link" title="Link"></i>

                                        </div>
                                    </div>

                                    <button class="btn btn-primary">Save Summary Card</button>
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
        .icon-preview i {
            font-size: 18px;
        }

        .icon-picker i {
            font-size: 18px;
            padding: 6px;
            margin: 3px;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .icon-picker i:hover {
            background: #f1f1f1;
        }

        .ui-state-highlight {
            height: 42px;
            border: 1px dashed #ccc;
            background: #f8f8f8;
        }
    </style>

    <script>
        $(function () {

            $("#selected-summary-fields").sortable({
                placeholder: "ui-state-highlight"
            });

            /* ADD FIELD */
            $(document).on('click', '.add-summary-field', function () {
                let li = $(this).closest('li');
                let key = li.data('key');
                let label = li.data('label');

                if ($('#selected-summary-fields li[data-key="' + key + '"]').length) return;

                $('#selected-summary-fields').append(`
          <li class="list-group-item d-flex align-items-center"
              data-key="${key}" data-label="${label}">
            <input type="text" class="form-control mr-2 icon-input"
                   placeholder="fa fa-user" style="max-width:130px;">
            <input type="color" class="form-control mr-2 color-input"
                   value="#000000" style="width:55px;padding:2px;">
            <span class="icon-preview mr-3">
              <i class="fa fa-user" style="color:#000000"></i>
            </span>
            <span class="flex-grow-1">${label}</span>
            <button type="button" class="btn btn-sm btn-danger remove-summary-field">×</button>
          </li>
        `);
            });

            /* REMOVE */
            $(document).on('click', '.remove-summary-field', function () {
                $(this).closest('li').remove();
            });

            /* ICON PICKER */
            $(document).on('click', '.icon-picker i', function () {
                let icon = $(this).data('icon');
                let active = $('#selected-summary-fields li').last();
                let color = active.find('.color-input').val();

                active.find('.icon-input').val(icon);
                active.find('.icon-preview i')
                    .attr('class', icon)
                    .css('color', color);
            });

            /* LIVE ICON PREVIEW */
            $(document).on('keyup', '.icon-input', function () {
                $(this).siblings('.icon-preview')
                    .find('i')
                    .attr('class', $(this).val());
            });

            /* LIVE COLOR PREVIEW */
            $(document).on('change', '.color-input', function () {
                $(this).siblings('.icon-preview')
                    .find('i')
                    .css('color', $(this).val());
            });

            /* SAVE */
            $('#summary-card-form').submit(function (e) {
                e.preventDefault();

                let cards = [];
                $('#selected-summary-fields li').each(function (i) {
                    cards.push({
                        field_key: $(this).data('key'),
                        label: $(this).data('label'),
                        icon: $(this).find('.icon-input').val(),
                        color: $(this).find('.color-input').val(),
                        position: i
                    });
                });

                $.post("<?php echo e(route('admin.form.summary-card.store', $form->id)); ?>", {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cards
                }, function () {
                    Swal.fire('Saved!', 'Summary card updated.', 'success')
                        .then(() => location.href = "<?php echo e(route('admin.form.index')); ?>");
                });
            });

        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/summary-card.blade.php ENDPATH**/ ?>
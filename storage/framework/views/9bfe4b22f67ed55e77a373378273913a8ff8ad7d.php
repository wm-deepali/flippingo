

<?php $__env->startSection('content'); ?>
    <style>
        #ef-widgets {
            height: 100%;
            max-height: 100%;
            overflow-y: auto;
        }

        /* Side panels and canvas layout */
        .ef-loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .ef-sidebar-outer {
            border: 1px solid #ddd;
            background: #fff;
            height: 100%;
        }

        .ef-switcher {
            cursor: pointer;
        }

        #tab-fields {
            max-height: 650px;
            overflow: hidden scroll;
            height: 100%;
        }

        #canvas {
            background-color: #fff;
            color: #1d273b;
            min-height: 650px;
            margin-bottom: 20px;
            padding: 25px;
            border: 1px solid #dadfe5;
            border-radius: 4px;
        }

        #my-form {
            height: 100vh;
        }

        /* Modal button styling */
        .modal-footer .btn {
            margin-left: 5px;
        }

        .modal-footer .btn:first-child {
            margin-left: 0;
        }

        /* Highlight effect for copied fields */
        .highlight-copied {
            animation: highlightPulse 2s ease-in-out;
            border: 2px solid #28a745 !important;
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
        }

        @keyframes  highlightPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }

            100% {
                transform: scale(1);
            }
        }

        /* New field type styles */
        .nps-scale {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .nps-scale input[type="range"] {
            flex: 1;
        }

        .matrix-table {
            margin-top: 10px;
            overflow-x: auto;
        }

        .matrix-table table {
            font-size: 0.9em;
        }

        .signature-pad {
            cursor: crosshair;
        }

        .page-break {
            page-break-after: always;
        }

        .spacer {
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(0, 0, 0, .1) 10px,
                    rgba(0, 0, 0, .1) 20px);
        }

        .form-label {
            font-weight: bold;
        }

        #styles-panel {
            height: 100%;
            max-height: 650px;
            overflow: hidden scroll;
        }

        .card-padding {
            padding: 1.25rem 1.25rem
        }
    </style>
    <?php $__env->startPush('styles'); ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-okaidia.min.css">
    <?php $__env->stopPush(); ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row" id="form-builder-wrapper">

                    
                    <div id="ef-loading" class="ef-loading w-100">
                        <div class="spinner-border text-primary" role="status"><span
                                class="visually-hidden">Loading...</span></div>
                    </div>

                    <!-- Left Sidebar: Fields -->
                    <div id="ef-widgets" class="col-md-4 d-none">
                        <div class="ef-sidebar-outer p-2">

                            <!-- Tabs Navigation -->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item">
                                    <a href="#tab-fields" class="nav-link active" data-bs-toggle="tab">Fields</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-settings" class="nav-link" data-bs-toggle="tab">Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-code" class="nav-link" data-bs-toggle="tab">Code</a>
                                </li>
                            </ul>

                            <!-- Tabs Content -->
                            <div class="tab-content">
                                <div id="tab-fields" class="tab-pane fade show active card-padding">
                                    <!-- Fields list goes here -->
                                </div>

                                <div id="tab-settings" class="tab-pane fade card-padding">
                                    <form id="settings-form">
                                        <div class="form-group">
                                            <label for="form-name" class="form-label"><strong>Form Name</strong></label>
                                            <input type="text" class="form-control" id="form-name" name="form_name"
                                                value="Untitled Form" aria-describedby="formNameHelp">
                                            <div id="formNameHelp" class="form-text">
                                                Used for identifying the form on administration pages.
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="form-layout" class="form-label"><strong>Form Layout</strong></label>
                                            <select class="form-control" id="form-layout" name="form_layout">
                                                <option value="Vertical" selected>Vertical</option>
                                                <option value="Horizontal">Horizontal</option>
                                                <option value="Inline">Inline</option>
                                            </select>
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disable-elements"
                                                name="disable_elements">
                                            <label class="form-check-label" for="disable-elements"><strong>Disable form
                                                    elements</strong></label>
                                        </div>
                                    </form>
                                </div>

                                <div id="tab-code" class="tab-pane fade card-padding">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Source Code preview</h6>
                                        <a href="#" id="copy-code-btn" class="text-decoration-none">Copy</a>
                                    </div>
                                    <div class="p-0 rounded overflow-hidden border" style="border-color:#2d2d2d!important;">
                                        <pre class="mb-0"
                                            style="font-size:12px; max-height:420px; overflow-y:auto;"><code id="code-preview" class="language-markup"></code></pre>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    
                    <div id="ef-main" class="col-md-5 d-none">
                        <div id="canvas">
                            <form id="my-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <?php echo $formData->html; ?>

                            </form>
                        </div>
                        <div class="mt-3">
                            <button id="save-form-btn" type="button" class="btn btn-success">
                                <i class="fas fa-check me-2"></i> Update Form
                            </button>
                        </div>
                    </div>

                    
                    <div id="ef-styles" class="col-md-3 d-none">
                        <div class="ef-sidebar-outer p-2">
                            <h5>Design</h5>
                            <div id="styles-panel"></div>
                            <div class="mt-2">
                                <a href="#" id="collapse-styles">Collapse All</a> |
                                <a href="#" id="expand-styles">Expand All</a>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="savedModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Your form has been updated</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>What do you want to do?</p>
                                <div class="list-group">
                                    <a href="<?php echo e(route('admin.form.index')); ?>" class="list-group-item">Back to Form
                                        Manager</a>
                                    <a href="<?php echo e(route('admin.form.edit', $form->id)); ?>" id="editFormLink"
                                        class="list-group-item">Continue Editing</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="toast" class="toast text-bg-danger border-0">
                        <div class="d-flex">
                            <div class="toast-body">
                                <strong id="toast-status"></strong>
                                <span id="toast-message"></span>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>

                
                <?php echo $__env->make('admin.form.partials.field-edit-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <?php echo $__env->make('admin.form.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <script>
        $(function () {
            // Hide loader and show UI
            $('#ef-loading').hide();
            $('#ef-widgets, #ef-main, #ef-styles').removeClass('d-none');

            // Pre-fill Settings panel
            <?php if(isset($formData) && $formData->builder): ?>
                let builderSettings = <?php echo json_encode($formData->builder, 15, 512) ?>;
                $('#form-name').val(builderSettings.form_name || '<?php echo e($form->name); ?>');
                $('#form-layout').val(builderSettings.form_layout || 'Vertical').trigger('change');
                $('#disable-elements').prop('checked', builderSettings.disable_elements || false);
            <?php endif; ?>

                // Rebuild from JSON fields if required
                <?php if(isset($formData) && $formData->fields): ?>
                    let savedFields = <?php echo json_encode($formData->fields, 15, 512) ?>;
                    $('#my-form').empty();
                    savedFields.forEach(f => {
                        let $fieldElement = $(`<div class="form-group" data-field-id="${f.id}" data-field-type="${f.type}">${getFieldHtml(f.type, f.id)}</div>`);
                        setFieldData($fieldElement, f.properties || {});
                        applyConfigToField($fieldElement, f.type, f.properties || {});
                        $('#my-form').append($fieldElement);
                    });
                <?php endif; ?>

            updateCodePreview();

            // Save/Update handler
            $('#save-form-btn').off('click').on('click', function () {
                const $btn = $(this);
                const formData = new FormData();
                let fields = [];
                $('#canvas .form-group').each(function () {
                    let $field = $(this);
                    fields.push({
                        id: $field.data('field-id'),
                        type: $field.data('field-type'),
                        properties: getFieldData($field)
                    });
                });
                formData.append('fields', JSON.stringify(fields));
                formData.append('html', $('#canvas').html());
                formData.append('builder', JSON.stringify({
                    form_name: $('#form-name').val(),
                    form_layout: $('#form-layout').val(),
                    disable_elements: $('#disable-elements').is(':checked')
                }));
                formData.append('name', $('#form-name').val());
                formData.append('height', $('#canvas').outerHeight());
                formData.append('_method', 'PUT');

                $btn.prop('disabled', true);

                $.ajax({
                    url: "<?php echo e(route('admin.form.update', $form->id)); ?>",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res.success) {
                            $('#savedModal').modal('show');
                            $('#editFormLink').attr('href', res.edit_url);
                        } else {
                            showToast('Error', res.message || 'Update failed');
                            $btn.prop('disabled', false);
                        }
                    },
                    error: function () {
                        showToast('Error', 'Server error');
                        $btn.prop('disabled', false);
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\flippingo\resources\views/admin/form/edit.blade.php ENDPATH**/ ?>
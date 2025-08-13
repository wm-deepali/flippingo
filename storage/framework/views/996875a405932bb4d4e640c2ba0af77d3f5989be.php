

<?php $__env->startSection('title', __('Create Form')); ?>

<?php $__env->startSection('content'); ?>
<div class="form-create">
    <div class="page-body">
        <div class="container-xl">
            <div class="">
                <div id="ef-loading" class="ef-loading">
                    <div class="ef-loader">
                        <div class="spinner-border text-blue" role="status">
                            <span class="visually-hidden"><?php echo e(__('Loading')); ?>...</span>
                        </div>
                    </div>
                </div>
                <div id="ef-form-builder" class="row" style="display: none">

                    
                    <div id="ef-widgets" class="col-12 col-md-4">
                        <div class="ef-sidebar-outer">
                            <div class="ef-sidebar-left">
                                <div class="card-tabs">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified" id="formtabs" role="tablist">
                                        <li class="nav-item"><a href="#tab-ef-fields" class="nav-link active" data-bs-toggle="tab"><?php echo e(__('Fields')); ?></a></li>
                                        <li class="nav-item"><a href="#tab-ef-settings" class="nav-link" data-bs-toggle="tab"><?php echo e(__('Settings')); ?></a></li>
                                        <li class="nav-item"><a href="#tab-ef-code" class="nav-link" data-bs-toggle="tab"><?php echo e(__('Code')); ?></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-ef-fields" class="card tab-pane active show"></div>
                                        <div id="tab-ef-settings" class="card tab-pane"></div>
                                        <div id="tab-ef-code" class="card tab-pane"></div>
                                    </div>
                                </div>
                                <div id="ef-switcher-side-left" class="ef-switcher ef-switcher-side-left">
                                    <div id="ef-switcher-inner" class="ef-switcher-inner">
                                        <label id="ef-switcher-preview" class="ef-switcher-preview" title="<?php echo e(__('Hide Panel')); ?>">
                                            <span class="fas fa-chevron-left"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div id="ef-main" class="col-12 col-md-5">
                        
                        <div class="alert alert-primary alert-dismissible" style="display: none">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="alert-title"><?php echo e(__('Did you know?')); ?></h4>
                                    <div class="text-muted">
                                        <?php echo e(__('Just Click the Fields or Drag & Drop them to start building your form. It\'s fast, easy & fun.')); ?>

                                    </div>
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                        

                        <div id="ef-switcher-main-left" class="ef-switcher ef-switcher-main-left">
                            <div id="ef-switcher-inner" class="ef-switcher-inner">
                                <label id="ef-switcher-preview" class="ef-switcher-preview" title="<?php echo e(__('Show Panel')); ?>">
                                    <span class="fas fa-chevron-right"></span>
                                </label>
                            </div>
                        </div>

                        <div id="canvas">
                            <form id="my-form"></form>
                        </div>

                        <div id="ef-switcher-main-right" class="ef-switcher ef-switcher-main-right">
                            <div id="ef-switcher-inner" class="ef-switcher-inner">
                                <label id="ef-switcher-preview" class="ef-switcher-preview" title="<?php echo e(__('Show Panel')); ?>">
                                    <span class="fas fa-chevron-left"></span>
                                </label>
                            </div>
                        </div>

                        <div id="messages">
                            <div data-alerts="alerts"
                                 data-titles="{'warning': '<em><?php echo e(__('Warning!')); ?></em>'}"
                                 data-ids="myid" data-fade="2000"></div>
                        </div>

                        <div id="actions">
                            <input id="formId" type="hidden" value="">
                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-default saveForm"
                                        data-endpoint="<?php echo e(route('admin.form.store')); ?>"
                                        data-aftersave="showMessage" data-url="">
                                    <span class="fas fa-check me-2"></span>
                                    <span id="saveText"><?php echo e(__('Save Form')); ?></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-default dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="dropdown-item saveForm"
                                           data-endpoint="<?php echo e(route('admin.form.store')); ?>"
                                           data-aftersave="open"
                                           data-url="<?php echo e(route('admin.form.store')); ?>">
                                            <?php echo e(__('Save & View Form')); ?>

                                        </a>
                                    </li>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('createTemplates')): ?>
                                        <li>
                                            <a href="#" class="dropdown-item saveForm"
                                               data-endpoint="<?php echo e(route('admin.form.store')); ?>" data-aftersave="redirect"
                                               data-url="<?php echo e(route('templates.index')); ?>">
                                                <?php echo e(__('Save Form as Template')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div id="ef-styles" class="col-12 col-md-3">
                        <div class="ef-sidebar-outer">
                            <div class="ef-sidebar-right">
                                <div id="ef-switcher-side-right" class="ef-switcher ef-switcher-side-right">
                                    <div id="ef-switcher-inner" class="ef-switcher-inner">
                                        <label id="ef-switcher-preview" class="ef-switcher-preview" title="<?php echo e(__('Hide Panel')); ?>">
                                            <span class="fas fa-chevron-right"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <?php echo e(__('Design')); ?>

                                        <div class="float-end">
                                            <span id="loading-styles"><small><?php echo e(__('Loading...')); ?></small></span>
                                            <div id="dropdown-styles" class="dropdown">
                                                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                                    <span class="fas fa-ellipsis-v"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" id="copy-styles" class="dropdown-item"><span class="dropdown-item-icon"><span class="fal fa-copy mx-2"></span></span> <?php echo e(__('Copy')); ?></a>
                                                    <a href="#" id="paste-styles" class="dropdown-item"><span class="dropdown-item-icon"><span class="far fa-paste mx-2"></span></span> <?php echo e(__('Paste')); ?></a>
                                                    <a href="#" id="reset-styles" class="dropdown-item"><span class="dropdown-item-icon"><span class="far fa-redo mx-2"></span></span> <?php echo e(__('Reset')); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="styles" class="card-body"></div>
                                </div>
                                <div id="ef-styles-tools" class="mt-2 ef-styles-tools">
                                    <a href="#" id="ef-styles-collapse-all"><?php echo e(__('Collapse All')); ?></a>
                                    <span class="ef-styles-separator">|</span>
                                    <a href="#" id="ef-styles-expand-all"><?php echo e(__('Expand All')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    $options = [
        "homeUrl" => url('/'),
        "libUrl" => asset("/static_files/js/form.builder/lib/"),
        "i18nUrl" => route('admin.ajax.builder.phrases'),
        "componentsUrl" => route('admin.ajax.builder.components'),
        "initPoint" => route('admin.ajax.initForm', ['template' => []]),
        "endPoint" => route('admin.ajax.createForm'),
        "reCaptchaSiteKey" => config('services.recaptcha.site_key'),
        "afterSave" => 'showMessage',
        "url" => route('admin.form.index'),
        "_csrf" => csrf_token(),
    ];
?>

<script>
    window.options = <?php echo json_encode($options, 15, 512) ?>;
</script>



<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/prism.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/spectrum.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/spectrum-kv.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/grapick.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/jquery.fontselect.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/jquery.flexdatalist.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/libs/simplebar.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('themes/next/assets/css/form.builder.min.css')); ?>">

<script src="<?php echo e(asset('themes/next/assets/libs/tinymce/tinymce.min.js')); ?>"></script>



    <script src="<?php echo e(asset('static_files/js/form.builder/lib/require.js')); ?>" data-main="<?php echo e(asset('static_files/js/form.builder/main-built.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/new-create.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.form.index')); ?>">Forms</a></li>
                        <li class="breadcrumb-item active">Form Settings</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
                    <div class="card card-bordered shadow-sm">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Form Settings</h4>
                        </div>
                        <div class="card-body">
                            
                            
                            <ul class="nav nav-tabs" id="customTabs">
                                <li class="nav-item">
                                    <a href="#form-settings" class="nav-link active">Form Settings</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="#confirmation-settings" class="nav-link">Confirmation Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#notification-settings" class="nav-link">Notification Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#ui-settings" class="nav-link">UI Settings</a>
                                </li> -->
                            </ul>

                            
                            <div class="tab-content mt-3">
                                
                                <div class="tab-pane active" id="form-settings">
                                    <?php echo $__env->make('admin.form.partials.settings-form', [
                                        'form' => $form,
                                        'languages' => $languages,
                                        'users' => [],
                                        'timezones' => [],
                                        'time_units' => [],
                                        'total_limit_actions' => [],
                                        'user_limit_types'=> []
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                
                                <div class="tab-pane" id="confirmation-settings">
                                    <?php echo $__env->make('admin.form.partials.settings-confirmation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                
                                <div class="tab-pane" id="notification-settings">
                                    <?php echo $__env->make('admin.form.partials.settings-notification', [
                                        'formEmail' => [],
                                        'emails' => [],
                                        'names' => [],
                                        'emailFields' => []
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                
                                <div class="tab-pane" id="ui-settings">
                                    <?php echo $__env->make('admin.form.partials.settings-ui', [
                                        'formUI' => [],
                                        'uiWidgets' => [],
                                        'themes' => []
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>

                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Hide inactive panes */
    .tab-pane { display: none; }
    .tab-pane.active { display: block; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('#customTabs .nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabLinks.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active from all links and panes
            tabLinks.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Add active to clicked link and its related pane
            this.classList.add('active');
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.classList.add('active');
            }
        });
    });
});


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/settings.blade.php ENDPATH**/ ?>
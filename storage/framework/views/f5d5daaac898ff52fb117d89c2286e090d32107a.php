<div class="row g-3">

    
    <div class="col-md-6">
        <label class="form-label"><?php echo app('translator')->get('Theme'); ?></label>
        <select name="theme" class="form-select">
            <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" @selected(old('theme', $formUI->theme) == $key)><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo app('translator')->get('Additional UI Widgets'); ?></label>
        <select name="ui_widgets[]" class="form-select select2" multiple>
            <?php $__currentLoopData = $uiWidgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widgetKey => $widgetLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($widgetKey); ?>" @selected(collect(old('ui_widgets', $formUI->ui_widgets))->contains($widgetKey))>
                    <?php echo e($widgetLabel); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-12">
        <label class="form-label"><?php echo app('translator')->get('Form Preview'); ?></label>
        <div class="border bg-light p-3 rounded">
            <iframe src="" width="100%" height="300" style="border:0;"></iframe>
        </div>
    </div>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\flippingo\resources\views/admin/form/partials/settings-ui.blade.php ENDPATH**/ ?>
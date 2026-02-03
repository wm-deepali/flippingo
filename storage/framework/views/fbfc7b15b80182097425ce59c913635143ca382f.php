<div class="form-group country-field" style="<?php echo e($enableCountry ? '' : 'display:none;'); ?>">
    <label>Select Country</label>
    <select name="country" class="form-control">
        <option value="">Select Country</option>

        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($country->id); ?>"
                <?php echo e(!$enableCountry && $country->name === 'India' ? 'selected' : ''); ?>>
                <?php echo e($country->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/partials/country-dropdown.blade.php ENDPATH**/ ?>
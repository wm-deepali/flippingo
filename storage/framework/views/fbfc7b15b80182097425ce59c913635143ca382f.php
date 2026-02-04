<?php if($enableCountry): ?>
    
    <div class="form-group country-field">
        <label><?php echo e($countryLabel ?? 'Select Country'); ?></label>

        <select name="country" class="form-control">
            <option value="">
                <?php echo e($countryLabel ?? 'Select Country'); ?>

            </option>

            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>">
                    <?php echo e($country->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
<?php else: ?>
    
    <?php
        $india = $countries->firstWhere('name', 'India');
    ?>

    <?php if($india): ?>
        <input type="hidden" name="country" value="<?php echo e($india->id); ?>">
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/partials/country-dropdown.blade.php ENDPATH**/ ?>
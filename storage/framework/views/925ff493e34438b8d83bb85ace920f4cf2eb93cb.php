<div class="row g-3">

    
    <div class="col-md-6">
        <label class="form-label"><?php echo app('translator')->get('Send To Email'); ?></label>
        <select name="to_emails[]" class="form-select select2" multiple>
            <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emailOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($emailOption); ?>" @selected(collect(old('to_emails', $formEmail->to_emails))?->contains($emailOption))>
                    <?php echo e($emailOption); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo app('translator')->get('CC'); ?></label>
        <select name="cc_emails[]" class="form-select select2" multiple>
            <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emailOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($emailOption); ?>" @selected(collect(old('cc_emails', $formEmail->cc_emails))?->contains($emailOption))>
                    <?php echo e($emailOption); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo app('translator')->get('From Name'); ?></label>
        <input type="text" name="from_name" class="form-control"
            value="<?php echo e(old('from_name', $formEmail->from_name ?? '')); ?>">
    </div>

    
    <div class="col-md-6">
        <label class="form-label"><?php echo app('translator')->get('From Email'); ?></label>
        <input type="email" name="from_email" class="form-control"
            value="<?php echo e(old('from_email', $formEmail->from_email ?? '')); ?>">
    </div>

    
    <div class="col-12">
        <label class="form-label"><?php echo app('translator')->get('Subject'); ?></label>
        <input type="text" name="subject" class="form-control" value="<?php echo e(old('subject', $formEmail->subject ?? '')); ?>">
    </div>

    
    <div class="col-12">
        <label class="form-label"><?php echo app('translator')->get('Email Message'); ?></label>
        <textarea name="message" class="form-control"
            rows="4"><?php echo e(old('message', $formEmail->message ?? '')); ?></textarea>
    </div>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\flippingo\resources\views/admin/form/partials/settings-notification.blade.php ENDPATH**/ ?>
<div class="row g-3">


    
    <div class="col-md-12 form-group">
        <label class="form-label"><?php echo app('translator')->get('Confirms that the submission was successful with:'); ?></label>
        <select name="type" id="type" class="form-control">
            <option value="0" <?php echo e(old('type', $formConfirmation->type ?? 'message') == '0' ? 'selected' : ''); ?>>
                <?php echo app('translator')->get('Message above Form'); ?>
            </option>
            <option value="1" <?php echo e(old('type', $formConfirmation->type ?? 'redirect') == '1' ? 'selected' : ''); ?>>
                <?php echo app('translator')->get('Only Message'); ?>
            </option>
            <option value="2" <?php echo e(old('type', $formConfirmation->type ?? 'reload') == '2' ? 'selected' : ''); ?>>
                <?php echo app('translator')->get('Redirection to Another Page'); ?>
            </option>
        </select>
    </div>

    
    <div class="col-md-6 form-group">
        <label class="form-label"><?php echo app('translator')->get('Page URL'); ?></label>
        <input type="url" name="redirect_url" class="form-control" placeholder="<?php echo app('translator')->get('Enter URL...'); ?>"
            value="<?php echo e(old('redirect_url', $formConfirmation->redirect_url ?? '')); ?>">
    </div>

    <div class="col-md-6 form-group">
        <label class="form-label"><?php echo app('translator')->get('Show Message and Redirect After'); ?></label>
        <div class="input-group">
            <input type="number" name="redirect_delay" class="form-control" min="0"
                value="<?php echo e(old('redirect_delay', $formConfirmation->redirect_delay ?? '3')); ?>">
            <span class="input-group-text"
                style="border-bottom-left-radius: 0px; border-top-left-radius: 0px"><?php echo app('translator')->get('seconds'); ?></span>
        </div>
    </div>


    <div class="col-md-12 form-group">
        <input type="checkbox" id="append_submission" name="append_submission" <?php echo e(old('append_submission', $formConfirmation->append_submission ?? false) ? 'checked' : ''); ?>>
        <label for="append_submission"><?php echo app('translator')->get('Append Submission Data to URL'); ?></label>
    </div>
    <div class="col-md-12 form-group">
        <input type="checkbox" id="replace_field_alias" name="replace_field_alias" <?php echo e(old('replace_field_alias', $formConfirmation->replace_field_alias ?? false) ? 'checked' : ''); ?>>
        <label for="replace_field_alias"><?php echo app('translator')->get("Replace Field Name with Field Alias when it's available"); ?></label>
    </div>
    <div class="col-md-12 form-group">
        <input type="checkbox" id="hide_form" name="hide_form" <?php echo e(old('hide_form', $formConfirmation->hide_form ?? false) ? 'checked' : ''); ?>>
        <label for="hide_form"><?php echo app('translator')->get('Hide Form'); ?></label>
    </div>
    <div class="col-md-12 form-group">
        <input type="checkbox" id="custom_html" name="custom_html" <?php echo e(old('custom_html', $formConfirmation->custom_html ?? false) ? 'checked' : ''); ?>>
        <label for="custom_html"><?php echo app('translator')->get('Custom HTML'); ?></label>
    </div>

    
    <div class="col-md-12 form-group">
        <label class="form-label"><?php echo app('translator')->get('Your Message'); ?></label>
        <textarea name="message" class="form-control" rows="2"
            placeholder="<?php echo app('translator')->get('Your Confirmation Message...'); ?>"><?php echo e(old('message', $formConfirmation->message ?? '')); ?></textarea>
        <small class="form-text text-muted"><?php echo app('translator')->get('Enter a curly bracket "{" to merge fields.'); ?></small>
    </div>

    
    <div class="col-md-12 form-group">
        <label class="form-label"><?php echo app('translator')->get('Show different messages with conditional logic'); ?></label>
        <div class="border p-3 rounded bg-light mb-2">
            <strong><?php echo app('translator')->get('Conditional Logic'); ?></strong>
            
            <button type="button" class="btn btn-primary btn-sm"><?php echo app('translator')->get('Add Rule'); ?></button>
            <span
                class="text-muted ms-2"><?php echo app('translator')->get('Conditional logic builder can be implemented here using JS plugin.'); ?></span>
        </div>
    </div>
</div>



<div class="col-12">
    <h5 class="mt-2 border-bottom pb-1"><?php echo app('translator')->get('Submission Settings'); ?></h5>
</div><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/partials/settings-confirmation.blade.php ENDPATH**/ ?>
<form id="formSettings" action="<?php echo e(route('admin.form.settings.update', $form->id)); ?>" method="POST">

    <div class="row g-3">

        
        <div class="col-md-6 form-group">
            <label class="form-label"><?php echo app('translator')->get('Form Name'); ?></label>
            <input type="text" name="name" class="form-control" placeholder="<?php echo app('translator')->get('Enter name...'); ?>"
                value="<?php echo e(old('name', $form->name ?? '')); ?>" required>
        </div>

        
        <div class="col-md-6 form-group">
            <label class="form-label"><?php echo app('translator')->get('Slug'); ?></label>
            <input type="text" name="slug" class="form-control" placeholder="<?php echo app('translator')->get('Enter slug...'); ?>"
                value="<?php echo e(old('slug', $form->slug ?? '')); ?>" readonly>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Language'); ?></label>
            <select name="language" class="form-control">
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($code); ?>" <?php echo e(old('language', $form->language ?? '') == $code ? 'selected' : ''); ?>>
                        <?php echo e($label); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Used to display validation messages.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Text Direction'); ?></label>
            <select name="text_direction" class="form-control">
                <option value="ltr" <?php echo e(old('text_direction', $form->text_direction ?? 'ltr') == 'ltr' ? 'selected' : ''); ?>>Left to Right</option>
                <option value="rtl" <?php echo e(old('text_direction', $form->text_direction ?? 'ltr') == 'rtl' ? 'selected' : ''); ?>>Right to Left</option>
            </select>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Status'); ?></label>
            <select name="status" class="form-control">
                <option value="1" <?php echo e(old('status', $form->status ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('status', $form->status ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Disable it at any time.'); ?></small>
        </div>


        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Private?'); ?></label>
            <select name="is_private" class="form-control">
                <option value="1" <?php echo e(old('is_private', $form->is_private ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('is_private', $form->is_private ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Will require sign in to access the form.'); ?></small>
        </div>


        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('changeFormsOwner', [$form])): ?>
            <div class="col-md-3 form-group">
                <label class="form-label"><?php echo app('translator')->get('Created By'); ?></label>
                <select name="created_by" class="form-control">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('created_by', $form->created_by ?? '') == $id ? 'selected' : ''); ?>>
                            <?php echo e($name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php endif; ?>

        
        <div class="col-12 form-group">
            <label class="form-label"><?php echo app('translator')->get('Message'); ?></label>
            <textarea name="message" class="form-control" rows="2"
                placeholder="<?php echo app('translator')->get('Enter message...'); ?>"><?php echo e(old('message', $form->message ?? '')); ?></textarea>
            <small class="form-text text-muted"><?php echo app('translator')->get('Message displayed when form has been disabled.'); ?></small>
        </div>

        
        <div class="col-md-6 form-group">
            <label class="form-label"><?php echo app('translator')->get('Shared With'); ?></label>
            <select name="shared_with" id="shared_with_select" class="form-control">
                <option value="none" <?php echo e(old('shared_with', $form->shared_with ?? 'none') == 'none' ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('None'); ?>
                </option>
                <option value="everyone" <?php echo e(old('shared_with', $form->shared_with ?? 'none') == 'everyone' ? 'selected' : ''); ?>><?php echo app('translator')->get('Everyone'); ?></option>
                <option value="users" <?php echo e(old('shared_with', $form->shared_with ?? 'none') == 'users' ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Specific Users'); ?>
                </option>
            </select>
        </div>


        
        <div class="col-md-6 form-group" id="users_access_group"
            style="<?php echo e(old('shared_with', $form->shared_with ?? 'none') == 'users' ? '' : 'display:none;'); ?>">
            <label class="form-label"><?php echo app('translator')->get('Users'); ?></label>
            <select name="users[]" class="form-control" multiple>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($id != ($form->created_by ?? null)): ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(collect(old('users', $form->users ?? []))->contains($id) ? 'selected' : ''); ?>><?php echo e($name); ?>

                        </option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('These users will have access to this form.'); ?></small>
        </div>


        
        <div class="col-12">
            <h5 class="mt-2 border-bottom pb-1"><?php echo app('translator')->get('Submission Settings'); ?></h5>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Generate Submission Number'); ?></label>
            <input type="text" name="submission_number" class="form-control"
                value="<?php echo e(old('submission_number', $form->submission_number ?? '')); ?>">
            <small class="form-text text-muted"><?php echo app('translator')->get('The start number.'); ?></small>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Number Width'); ?></label>
            <input type="text" name="submission_number_width" class="form-control"
                value="<?php echo e(old('submission_number_width', $form->submission_number_width ?? '')); ?>">
            <small class="form-text text-muted"><?php echo app('translator')->get('Adds leading zeros until filling it.'); ?></small>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Number Prefix'); ?></label>
            <input type="text" name="submission_number_prefix" class="form-control"
                value="<?php echo e(old('submission_number_prefix', $form->submission_number_prefix ?? '')); ?>">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Number Suffix'); ?></label>
            <input type="text" name="submission_number_suffix" class="form-control"
                value="<?php echo e(old('submission_number_suffix', $form->submission_number_suffix ?? '')); ?>">
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Save Submissions'); ?></label>
            <select name="save" class="form-control">
                <option value="1" <?php echo e(old('save', $form->save ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('save', $form->save ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Store submitted form data.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Owner Scope'); ?></label>
            <select name="submission_scope" class="form-control">
                <option value="1" <?php echo e(old('submission_scope', $form->submission_scope ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('submission_scope', $form->submission_scope ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Manage own submissions only.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Protected Files'); ?></label>
            <select name="protected_files" class="form-control">
                <option value="1" <?php echo e(old('protected_files', $form->protected_files ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('protected_files', $form->protected_files ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Disable anonymous user access.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Time Zone For Submissions'); ?></label>
            <select name="submission_timezone" class="form-control">
                <option value=""><?php echo app('translator')->get('Select...'); ?></option>
                <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tz => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tz); ?>" <?php echo e(old('submission_timezone', $form->submission_timezone ?? '') == $tz ? 'selected' : ''); ?>>
                        <?php echo e($name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('To be displayed in your submissions.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Submission Date Format'); ?></label>
            <input type="text" name="submission_dateformat" class="form-control" placeholder="yyyy-MM-dd HH:mm:ss"
                value="<?php echo e(old('submission_dateformat', $form->submission_dateformat ?? '')); ?>">
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Editable Submissions'); ?></label>
            <select name="submission_editable" id="submission_editable_select" class="form-control">
                <option value="1" <?php echo e(old('submission_editable', $form->submission_editable ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?></option>
                <option value="0" <?php echo e(!old('submission_editable', $form->submission_editable ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?></option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Respondents can edit after submit.'); ?></small>
        </div>

        
        <div id="editable_options"
            style="<?php echo e(old('submission_editable', $form->submission_editable ?? false) ? '' : 'display:none;'); ?>">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="form-label"><?php echo app('translator')->get('Editable Time Length'); ?></label>
                    <input type="number" name="submission_editable_time_length" class="form-control"
                        value="<?php echo e(old('submission_editable_time_length', $form->submission_editable_time_length ?? '')); ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label class="form-label"><?php echo app('translator')->get('Editable Time Unit'); ?></label>
                    <select name="submission_editable_time_unit" class="form-control">
                        <option value=""><?php echo app('translator')->get('Select...'); ?></option>
                        <?php $__currentLoopData = $time_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php echo e(old('submission_editable_time_unit', $form->submission_editable_time_unit ?? '') == $val ? 'selected' : ''); ?>>
                                <?php echo e($label); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-12 form-group">
                <label class="form-label"><?php echo app('translator')->get('Editable Conditions'); ?></label>
                <div class="alert alert-info mb-0">
                    <?php echo app('translator')->get('Conditional logic builder can be implemented here using a JS plugin.'); ?>
                </div>
            </div>
        </div>

        
        <div class="col-12 mt-4">
            <h5 class="border-bottom pb-1"><?php echo app('translator')->get('Form Activity & Limits'); ?></h5>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Limit Total Number of Submissions'); ?></label><br>
            <select name="total_limit" id="total_limit" class="form-control">
                <option value="1" <?php echo e(old('total_limit', $form->total_limit ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('total_limit', default: $form->total_limit ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>

        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Total Limit Action'); ?></label>
            <select name="total_limit_action" class="form-control">
                <option value="0"><?php echo app('translator')->get('Select...'); ?></option>
                <?php $__currentLoopData = $total_limit_actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php echo e(old('total_limit_action', $form->total_limit_action ?? '') == $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Limit Submissions per User'); ?></label><br>
            <select name="user_limit" id="user_limit" class="form-control">
                <option value="1" <?php echo e(old('user_limit', $form->user_limit ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('user_limit', default: $form->user_limit ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('User Limit Type'); ?></label>
            <select name="user_limit_type" class="form-control">
                <option value=""><?php echo app('translator')->get('Select...'); ?></option>
                <?php $__currentLoopData = $user_limit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php echo e(old('user_limit_type', $form->user_limit_type ?? '') == $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Total Limit Number'); ?></label>
            <input type="number" name="total_limit_number" class="form-control"
                value="<?php echo e(old('total_limit_number', $form->total_limit_number ?? '')); ?>">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Total Limit Time Unit'); ?></label>
            <select name="total_limit_time_unit" class="form-control">
                <option value=""><?php echo app('translator')->get('Select...'); ?></option>
                <?php $__currentLoopData = $time_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php echo e(old('total_limit_time_unit', $form->total_limit_time_unit ?? '') == $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('User Limit Number'); ?></label>
            <input type="number" name="user_limit_number" class="form-control"
                value="<?php echo e(old('user_limit_number', $form->user_limit_number ?? '')); ?>">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('User Limit Time Unit'); ?></label>
            <select name="user_limit_time_unit" class="form-control">
                <option value=""><?php echo app('translator')->get('Select...'); ?></option>
                <?php $__currentLoopData = $time_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php echo e(old('user_limit_time_unit', $form->user_limit_time_unit ?? '') == $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="col-12">
            <h5 class="border-bottom pb-1"><?php echo app('translator')->get('Schedule'); ?></h5>
        </div>


        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Enable Schedule'); ?></label><br>
            <select name="schedule" id="schedule_select" class="form-control">
                <option value="1" <?php echo e(old('schedule', $form->schedule ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('schedule', $form->schedule ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?>
                </option>
            </select>
        </div>

        <div class="col-md-3 form-group" id="schedule_start_date_group">
            <label class="form-label"><?php echo app('translator')->get('Start Date'); ?></label>
            <input type="datetime-local" name="schedule_start_date" class="form-control"
                value="<?php echo e(old('schedule_start_date', $form->schedule_start_date ?? '')); ?>">
        </div>

        <div class="col-md-3 form-group" id="schedule_end_date_group">
            <label class="form-label"><?php echo app('translator')->get('End Date'); ?></label>
            <input type="datetime-local" name="schedule_end_date" class="form-control"
                value="<?php echo e(old('schedule_end_date', $form->schedule_end_date ?? '')); ?>">
        </div>

        
        <div class="col-12 mt-2">
            <h5 class="border-bottom pb-1"><?php echo app('translator')->get('Form Security'); ?></h5>
        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Authorized URLs'); ?></label>
            <select name="authorized_urls" id="authorized_urls_select" class="form-control">
                <option value="1" <?php echo e(old('authorized_urls', $form->authorized_urls ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('authorized_urls', $form->authorized_urls ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Restrict access to authorized websites.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group" id="urls_group"
            style="<?php echo e(old('authorized_urls', $form->authorized_urls ?? false) ? '' : 'display:none;'); ?>">
            <label class="form-label"><?php echo app('translator')->get('URLs'); ?></label>
            <input type="text" name="urls" class="form-control" value="<?php echo e(old('urls', $form->urls ?? '')); ?>">
            <small class="form-text text-muted"><?php echo app('translator')->get('Enter comma separated domain names.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group" id="hideform_group"
            style="<?php echo e(old('authorized_urls', $form->authorized_urls ?? false) ? '' : 'display:none;'); ?>">
            <label class="form-label"><?php echo app('translator')->get('Hide form in unauthorized URLs'); ?></label>
            <select name="authorized_urls_error_type" id="hideform_select" class="form-control">
                <option value="1" <?php echo e(old('authorized_urls_error_type', $form->authorized_urls_error_type ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('authorized_urls_error_type', $form->authorized_urls_error_type ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
        </div>

        
        <div class="col-md-3 form-group" id="error_message_group"
            style="<?php echo e(old('authorized_urls_error_type', $form->authorized_urls_error_type ?? false) ? '' : 'display:none;'); ?>">
            <label class="form-label"><?php echo app('translator')->get('Unauthorized Url Message'); ?></label>
            <input type="text" name="authorized_urls_error_message" class="form-control"
                value="<?php echo e(old('authorized_urls_error_message', $form->authorized_urls_error_message ?? '')); ?>">
            <small class="form-text text-muted"><?php echo app('translator')->get('Message displayed when the form is hidden.'); ?></small>

        </div>

        
        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Use Password'); ?></label>
            <select name="use_password" id="use_password_select" class="form-control">
                <option value="1" <?php echo e(old('use_password', $form->use_password ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('use_password', $form->use_password ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Enable password protection.'); ?></small>
        </div>

        
        <div class="col-md-3 form-group" id="password_group"
            style="<?php echo e(old('use_password', $form->use_password ?? false) ? '' : 'display:none;'); ?>">
            <label class="form-label"><?php echo app('translator')->get('Password'); ?></label>
            <input type="password" name="password" class="form-control"
                value="<?php echo e(old('password', $form->password ?? '')); ?>">
            <small class="form-text text-muted"><?php echo app('translator')->get('Only those who know the password can see your form.'); ?></small>
        </div>


        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Spam filter'); ?></label>
            <select name="honeypot" id="honeypot_select" class="form-control">
                <option value="1" <?php echo e(old('honeypot', $form->honeypot ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('honeypot', $form->honeypot ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Adds honeypot field to filter spam.'); ?></small>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('No validate'); ?></label>
            <select name="novalidate" id="novalidate_select" class="form-control">
                <option value="1" <?php echo e(old('novalidate', $form->novalidate ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('novalidate', $form->novalidate ?? false) ? 'selected' : ''); ?>>
                    <?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Disable client side validation.'); ?></small>
        </div>



        
        <div class="col-12 mt-2">
            <h5 class="border-bottom pb-1"><?php echo app('translator')->get('Other Options'); ?></h5>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('IP Tracking'); ?></label>
            <select name="ip_tracking" id="ip_tracking_select" class="form-control">
                <option value="1" <?php echo e(old('ip_tracking', $form->ip_tracking ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('ip_tracking', $form->ip_tracking ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Collect IP addresses.'); ?></small>

        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Analytics'); ?></label>
            <select name="analytics" id="analytics_select" class="form-control">
                <option value="1" <?php echo e(old('analytics', $form->analytics ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('analytics', $form->analytics ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Enable Form Tracking.'); ?></small>

        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Auto Complete'); ?></label>
            <select name="autocomplete" id="autocomplete_select" class="form-control">
                <option value="1" <?php echo e(old('autocomplete', $form->autocomplete ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('autocomplete', $form->autocomplete ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get("Enable the browser's autocomplete."); ?></small>

        </div>

        <div class="col-md-3 form-group">
            <label class="form-label"><?php echo app('translator')->get('Save & Resume Later'); ?></label>
            <select name="resume" id="resume_select" class="form-control">
                <option value="1" <?php echo e(old('resume', $form->resume ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('Yes'); ?>
                </option>
                <option value="0" <?php echo e(!old('resume', $form->resume ?? false) ? 'selected' : ''); ?>><?php echo app('translator')->get('No'); ?>
                </option>
            </select>
            <small class="form-text text-muted"><?php echo app('translator')->get('Autosave and continue filling later.'); ?></small>
        </div>


        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('Save Settings'); ?>
            </button>
        </div>

    </div>
</form>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function toggleUsersInput() {
                let value = document.getElementById('shared_with_select').value;
                let usersGroup = document.getElementById('users_access_group');
                if (value === 'users') {
                    usersGroup.style.display = 'block';
                } else {
                    usersGroup.style.display = 'none';
                }
            }
            // Editable options show/hide
            function toggleEditableOptions() {
                var editableSelect = document.getElementById('submission_editable_select');
                var editableOptions = document.getElementById('editable_options');
                if (editableSelect.value === '1') {
                    editableOptions.style.display = 'block';
                } else {
                    editableOptions.style.display = 'none';
                }
            }

            // Schedule → Date fields visibility
            function toggleScheduleDates() {
                let scheduleSelect = document.getElementById('schedule_select');
                let startDateGroup = document.getElementById('schedule_start_date_group');
                let endDateGroup = document.getElementById('schedule_end_date_group');

                if (scheduleSelect.value === '1') {
                    startDateGroup.style.display = 'block';
                    endDateGroup.style.display = 'block';
                } else {
                    startDateGroup.style.display = 'none';
                    endDateGroup.style.display = 'none';
                }
            }

            function toggleAuthorizedUrls() {
                let authorized = document.getElementById('authorized_urls_select').value;
                let urlsGroup = document.getElementById('urls_group');
                let hideFormGroup = document.getElementById('hideform_group');

                if (authorized === '1') {
                    urlsGroup.style.display = 'block';
                    hideFormGroup.style.display = 'block';
                } else {
                    urlsGroup.style.display = 'none';
                    hideFormGroup.style.display = 'none';
                    document.getElementById('error_message_group').style.display = 'none';
                }
            }

            function toggleHideForm() {
                let hideForm = document.getElementById('hideform_select').value;
                let errorMessageGroup = document.getElementById('error_message_group');
                if (hideForm === '1') {
                    errorMessageGroup.style.display = 'block';
                } else {
                    errorMessageGroup.style.display = 'none';
                }
            }

            function togglePassword() {
                let usePassword = document.getElementById('use_password_select').value;
                let passwordGroup = document.getElementById('password_group');
                passwordGroup.style.display = (usePassword === '1') ? 'block' : 'none';
            }


            // Initial check
            toggleUsersInput();
            toggleEditableOptions();
            toggleScheduleDates();
            toggleAuthorizedUrls();
            toggleHideForm();
            togglePassword();

            // Listen for changes
            document.getElementById('shared_with_select').addEventListener('change', toggleUsersInput);
            document.getElementById('submission_editable_select').addEventListener('change', toggleEditableOptions);
            document.getElementById('schedule_select').addEventListener('change', toggleScheduleDates);
            document.getElementById('authorized_urls_select').addEventListener('change', function () {
                toggleAuthorizedUrls();
                toggleHideForm();
            });

            document.getElementById('hideform_select').addEventListener('change', toggleHideForm);
            document.getElementById('use_password_select').addEventListener('change', togglePassword);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formSettings');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // prevent default form submission

        let formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            },
            body: formData
        })
        .then(response => {
            if (response.ok) return response.json();
            return response.json().then(errData => Promise.reject(errData));
        })
        .then(data => {
            // Success swal popup
            swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message || 'Settings saved successfully.',
            });

            // Optionally reload or update UI here
        })
        .catch(errors => {
            // Error swal popup
            let message = 'An unexpected error occurred.';
            if(errors.errors) {
                let errorMessages = [];
                Object.values(errors.errors).forEach(arr => {
                    arr.forEach(msg => errorMessages.push(msg));
                });
                message = errorMessages.join('\n');
            } else if (errors.message) {
                message = errors.message;
            }

            swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
            });
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/admin/form/partials/settings-form.blade.php ENDPATH**/ ?>
<form id="formSettings" action="{{ route('admin.form.settings.update', $form->id) }}" method="POST">

    <div class="row g-3">

        {{-- Name --}}
        <div class="col-md-6 form-group">
            <label class="form-label">@lang('Form Name')</label>
            <input type="text" name="name" class="form-control" placeholder="@lang('Enter name...')"
                value="{{ old('name', $form->name ?? '') }}" required>
        </div>

        {{-- Slug --}}
        <div class="col-md-6 form-group">
            <label class="form-label">@lang('Slug')</label>
            <input type="text" name="slug" class="form-control" placeholder="@lang('Enter slug...')"
                value="{{ old('slug', $form->slug ?? '') }}" readonly>
        </div>

        {{-- Language --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Language')</label>
            <select name="language" class="form-control">
                @foreach($languages as $code => $label)
                    <option value="{{ $code }}" {{ old('language', $form->language ?? '') == $code ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">@lang('Used to display validation messages.')</small>
        </div>

        {{-- Text Direction --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Text Direction')</label>
            <select name="text_direction" class="form-control">
                <option value="ltr" {{ old('text_direction', $form->text_direction ?? 'ltr') == 'ltr' ? 'selected' : '' }}>Left to Right</option>
                <option value="rtl" {{ old('text_direction', $form->text_direction ?? 'ltr') == 'rtl' ? 'selected' : '' }}>Right to Left</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Status')</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status', $form->status ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('status', $form->status ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Disable it at any time.')</small>
        </div>


        {{-- Private --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Private?')</label>
            <select name="is_private" class="form-control">
                <option value="1" {{ old('is_private', $form->is_private ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('is_private', $form->is_private ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Will require sign in to access the form.')</small>
        </div>


        {{-- Owner change --}}
        @can('changeFormsOwner', [$form])
            <div class="col-md-3 form-group">
                <label class="form-label">@lang('Created By')</label>
                <select name="created_by" class="form-control">
                    @foreach($users as $id => $name)
                        <option value="{{ $id }}" {{ old('created_by', $form->created_by ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endcan

        {{-- Message --}}
        <div class="col-12 form-group">
            <label class="form-label">@lang('Message')</label>
            <textarea name="message" class="form-control" rows="2"
                placeholder="@lang('Enter message...')">{{ old('message', $form->message ?? '') }}</textarea>
            <small class="form-text text-muted">@lang('Message displayed when form has been disabled.')</small>
        </div>

        {{-- Shared With --}}
        <div class="col-md-6 form-group">
            <label class="form-label">@lang('Shared With')</label>
            <select name="shared_with" id="shared_with_select" class="form-control">
                <option value="none" {{ old('shared_with', $form->shared_with ?? 'none') == 'none' ? 'selected' : '' }}>
                    @lang('None')
                </option>
                <option value="everyone" {{ old('shared_with', $form->shared_with ?? 'none') == 'everyone' ? 'selected' : '' }}>@lang('Everyone')</option>
                <option value="users" {{ old('shared_with', $form->shared_with ?? 'none') == 'users' ? 'selected' : '' }}>
                    @lang('Specific Users')
                </option>
            </select>
        </div>


        {{-- Users access (hidden/shown dynamically) --}}
        <div class="col-md-6 form-group" id="users_access_group"
            style="{{ old('shared_with', $form->shared_with ?? 'none') == 'users' ? '' : 'display:none;' }}">
            <label class="form-label">@lang('Users')</label>
            <select name="users[]" class="form-control" multiple>
                @foreach($users as $id => $name)
                    @if($id != ($form->created_by ?? null))
                        <option value="{{ $id }}" {{ collect(old('users', $form->users ?? []))->contains($id) ? 'selected' : '' }}>{{ $name }}
                        </option>
                    @endif
                @endforeach
            </select>
            <small class="form-text text-muted">@lang('These users will have access to this form.')</small>
        </div>


        {{-- Submission Settings --}}
        <div class="col-12">
            <h5 class="mt-2 border-bottom pb-1">@lang('Submission Settings')</h5>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Generate Submission Number')</label>
            <input type="text" name="submission_number" class="form-control"
                value="{{ old('submission_number', $form->submission_number ?? '') }}">
            <small class="form-text text-muted">@lang('The start number.')</small>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Number Width')</label>
            <input type="text" name="submission_number_width" class="form-control"
                value="{{ old('submission_number_width', $form->submission_number_width ?? '') }}">
            <small class="form-text text-muted">@lang('Adds leading zeros until filling it.')</small>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Number Prefix')</label>
            <input type="text" name="submission_number_prefix" class="form-control"
                value="{{ old('submission_number_prefix', $form->submission_number_prefix ?? '') }}">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Number Suffix')</label>
            <input type="text" name="submission_number_suffix" class="form-control"
                value="{{ old('submission_number_suffix', $form->submission_number_suffix ?? '') }}">
        </div>

        {{-- Save toggle --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Save Submissions')</label>
            <select name="save" class="form-control">
                <option value="1" {{ old('save', $form->save ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('save', $form->save ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Store submitted form data.')</small>
        </div>

        {{-- Submission Scope --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Owner Scope')</label>
            <select name="submission_scope" class="form-control">
                <option value="1" {{ old('submission_scope', $form->submission_scope ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('submission_scope', $form->submission_scope ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Manage own submissions only.')</small>
        </div>

        {{-- Protected Files --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Protected Files')</label>
            <select name="protected_files" class="form-control">
                <option value="1" {{ old('protected_files', $form->protected_files ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('protected_files', $form->protected_files ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Disable anonymous user access.')</small>
        </div>

        {{-- Timezone --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Time Zone For Submissions')</label>
            <select name="submission_timezone" class="form-control">
                <option value="">@lang('Select...')</option>
                @foreach($timezones as $tz => $name)
                    <option value="{{ $tz }}" {{ old('submission_timezone', $form->submission_timezone ?? '') == $tz ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">@lang('To be displayed in your submissions.')</small>
        </div>

        {{-- Date format --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Submission Date Format')</label>
            <input type="text" name="submission_dateformat" class="form-control" placeholder="yyyy-MM-dd HH:mm:ss"
                value="{{ old('submission_dateformat', $form->submission_dateformat ?? '') }}">
        </div>

        {{-- Editable toggle --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Editable Submissions')</label>
            <select name="submission_editable" id="submission_editable_select" class="form-control">
                <option value="1" {{ old('submission_editable', $form->submission_editable ?? false) ? 'selected' : '' }}>@lang('Yes')</option>
                <option value="0" {{ !old('submission_editable', $form->submission_editable ?? false) ? 'selected' : '' }}>@lang('No')</option>
            </select>
            <small class="form-text text-muted">@lang('Respondents can edit after submit.')</small>
        </div>

        {{-- Editable Options - Conditionally visible --}}
        <div id="editable_options"
            style="{{ old('submission_editable', $form->submission_editable ?? false) ? '' : 'display:none;' }}">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="form-label">@lang('Editable Time Length')</label>
                    <input type="number" name="submission_editable_time_length" class="form-control"
                        value="{{ old('submission_editable_time_length', $form->submission_editable_time_length ?? '') }}">
                </div>
                <div class="col-md-6 form-group">
                    <label class="form-label">@lang('Editable Time Unit')</label>
                    <select name="submission_editable_time_unit" class="form-control">
                        <option value="">@lang('Select...')</option>
                        @foreach($time_units as $val => $label)
                            <option value="{{ $val }}" {{ old('submission_editable_time_unit', $form->submission_editable_time_unit ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 form-group">
                <label class="form-label">@lang('Editable Conditions')</label>
                <div class="alert alert-info mb-0">
                    @lang('Conditional logic builder can be implemented here using a JS plugin.')
                </div>
            </div>
        </div>

        {{-- ===== Form Activity & Limits ===== --}}
        <div class="col-12 mt-4">
            <h5 class="border-bottom pb-1">@lang('Form Activity & Limits')</h5>
        </div>

        {{-- Total Limit --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Limit Total Number of Submissions')</label><br>
            <select name="total_limit" id="total_limit" class="form-control">
                <option value="1" {{ old('total_limit', $form->total_limit ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('total_limit', default: $form->total_limit ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>

        </div>

        {{-- Total Limit Action --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Total Limit Action')</label>
            <select name="total_limit_action" class="form-control">
                <option value="0">@lang('Select...')</option>
                @foreach($total_limit_actions as $val => $label)
                    <option value="{{ $val }}" {{ old('total_limit_action', $form->total_limit_action ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- User Limit --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Limit Submissions per User')</label><br>
            <select name="user_limit" id="user_limit" class="form-control">
                <option value="1" {{ old('user_limit', $form->user_limit ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('user_limit', default: $form->user_limit ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
        </div>

        {{-- User Limit Type --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('User Limit Type')</label>
            <select name="user_limit_type" class="form-control">
                <option value="">@lang('Select...')</option>
                @foreach($user_limit_types as $val => $label)
                    <option value="{{ $val }}" {{ old('user_limit_type', $form->user_limit_type ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- Limit Numbers & Units --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Total Limit Number')</label>
            <input type="number" name="total_limit_number" class="form-control"
                value="{{ old('total_limit_number', $form->total_limit_number ?? '') }}">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Total Limit Time Unit')</label>
            <select name="total_limit_time_unit" class="form-control">
                <option value="">@lang('Select...')</option>
                @foreach($time_units as $val => $label)
                    <option value="{{ $val }}" {{ old('total_limit_time_unit', $form->total_limit_time_unit ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('User Limit Number')</label>
            <input type="number" name="user_limit_number" class="form-control"
                value="{{ old('user_limit_number', $form->user_limit_number ?? '') }}">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('User Limit Time Unit')</label>
            <select name="user_limit_time_unit" class="form-control">
                <option value="">@lang('Select...')</option>
                @foreach($time_units as $val => $label)
                    <option value="{{ $val }}" {{ old('user_limit_time_unit', $form->user_limit_time_unit ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        {{-- ===== Schedule ===== --}}
        <div class="col-12">
            <h5 class="border-bottom pb-1">@lang('Schedule')</h5>
        </div>


        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Enable Schedule')</label><br>
            <select name="schedule" id="schedule_select" class="form-control">
                <option value="1" {{ old('schedule', $form->schedule ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('schedule', $form->schedule ?? false) ? 'selected' : '' }}>@lang('No')
                </option>
            </select>
        </div>

        <div class="col-md-3 form-group" id="schedule_start_date_group">
            <label class="form-label">@lang('Start Date')</label>
            <input type="datetime-local" name="schedule_start_date" class="form-control"
                value="{{ old('schedule_start_date', $form->schedule_start_date ?? '') }}">
        </div>

        <div class="col-md-3 form-group" id="schedule_end_date_group">
            <label class="form-label">@lang('End Date')</label>
            <input type="datetime-local" name="schedule_end_date" class="form-control"
                value="{{ old('schedule_end_date', $form->schedule_end_date ?? '') }}">
        </div>

        {{-- ===== Form Security ===== --}}
        <div class="col-12 mt-2">
            <h5 class="border-bottom pb-1">@lang('Form Security')</h5>
        </div>

        {{-- Authorized URLs --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Authorized URLs')</label>
            <select name="authorized_urls" id="authorized_urls_select" class="form-control">
                <option value="1" {{ old('authorized_urls', $form->authorized_urls ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('authorized_urls', $form->authorized_urls ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Restrict access to authorized websites.')</small>
        </div>

        {{-- URL field group (initially hidden unless Authorized URLs = Yes) --}}
        <div class="col-md-3 form-group" id="urls_group"
            style="{{ old('authorized_urls', $form->authorized_urls ?? false) ? '' : 'display:none;' }}">
            <label class="form-label">@lang('URLs')</label>
            <input type="text" name="urls" class="form-control" value="{{ old('urls', $form->urls ?? '') }}">
            <small class="form-text text-muted">@lang('Enter comma separated domain names.')</small>
        </div>

        {{-- Hide Form option --}}
        <div class="col-md-3 form-group" id="hideform_group"
            style="{{ old('authorized_urls', $form->authorized_urls ?? false) ? '' : 'display:none;' }}">
            <label class="form-label">@lang('Hide form in unauthorized URLs')</label>
            <select name="authorized_urls_error_type" id="hideform_select" class="form-control">
                <option value="1" {{ old('authorized_urls_error_type', $form->authorized_urls_error_type ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('authorized_urls_error_type', $form->authorized_urls_error_type ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
        </div>

        {{-- Error Message (only when Hide Form = Yes) --}}
        <div class="col-md-3 form-group" id="error_message_group"
            style="{{ old('authorized_urls_error_type', $form->authorized_urls_error_type ?? false) ? '' : 'display:none;' }}">
            <label class="form-label">@lang('Unauthorized Url Message')</label>
            <input type="text" name="authorized_urls_error_message" class="form-control"
                value="{{ old('authorized_urls_error_message', $form->authorized_urls_error_message ?? '') }}">
            <small class="form-text text-muted">@lang('Message displayed when the form is hidden.')</small>

        </div>

        {{-- Use Password --}}
        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Use Password')</label>
            <select name="use_password" id="use_password_select" class="form-control">
                <option value="1" {{ old('use_password', $form->use_password ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('use_password', $form->use_password ?? false) ? 'selected' : '' }}>@lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Enable password protection.')</small>
        </div>

        {{-- Password input --}}
        <div class="col-md-3 form-group" id="password_group"
            style="{{ old('use_password', $form->use_password ?? false) ? '' : 'display:none;' }}">
            <label class="form-label">@lang('Password')</label>
            <input type="password" name="password" class="form-control"
                value="{{ old('password', $form->password ?? '') }}">
            <small class="form-text text-muted">@lang('Only those who know the password can see your form.')</small>
        </div>


        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Spam filter')</label>
            <select name="honeypot" id="honeypot_select" class="form-control">
                <option value="1" {{ old('honeypot', $form->honeypot ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('honeypot', $form->honeypot ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Adds honeypot field to filter spam.')</small>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('No validate')</label>
            <select name="novalidate" id="novalidate_select" class="form-control">
                <option value="1" {{ old('novalidate', $form->novalidate ?? false) ? 'selected' : '' }}>
                    @lang('Yes')
                </option>
                <option value="0" {{ !old('novalidate', $form->novalidate ?? false) ? 'selected' : '' }}>
                    @lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Disable client side validation.')</small>
        </div>



        {{-- ===== Other Options ===== --}}
        <div class="col-12 mt-2">
            <h5 class="border-bottom pb-1">@lang('Other Options')</h5>
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('IP Tracking')</label>
            <select name="ip_tracking" id="ip_tracking_select" class="form-control">
                <option value="1" {{ old('ip_tracking', $form->ip_tracking ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('ip_tracking', $form->ip_tracking ?? false) ? 'selected' : '' }}>@lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Collect IP addresses.')</small>

        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Analytics')</label>
            <select name="analytics" id="analytics_select" class="form-control">
                <option value="1" {{ old('analytics', $form->analytics ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('analytics', $form->analytics ?? false) ? 'selected' : '' }}>@lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Enable Form Tracking.')</small>

        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Auto Complete')</label>
            <select name="autocomplete" id="autocomplete_select" class="form-control">
                <option value="1" {{ old('autocomplete', $form->autocomplete ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('autocomplete', $form->autocomplete ?? false) ? 'selected' : '' }}>@lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang("Enable the browser's autocomplete.")</small>

        </div>

        <div class="col-md-3 form-group">
            <label class="form-label">@lang('Save & Resume Later')</label>
            <select name="resume" id="resume_select" class="form-control">
                <option value="1" {{ old('resume', $form->resume ?? false) ? 'selected' : '' }}>@lang('Yes')
                </option>
                <option value="0" {{ !old('resume', $form->resume ?? false) ? 'selected' : '' }}>@lang('No')
                </option>
            </select>
            <small class="form-text text-muted">@lang('Autosave and continue filling later.')</small>
        </div>


        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> @lang('Save Settings')
            </button>
        </div>

    </div>
</form>

@push('scripts')
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
@endpush

@push('scripts')
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
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
@endpush

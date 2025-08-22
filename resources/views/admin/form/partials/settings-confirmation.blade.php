<div class="row g-3">


    {{-- Confirmation Type --}}
    <div class="col-md-12 form-group">
        <label class="form-label">@lang('Confirms that the submission was successful with:')</label>
        <select name="type" id="type" class="form-control">
            <option value="0" {{ old('type', $formConfirmation->type ?? 'message') == '0' ? 'selected' : '' }}>
                @lang('Message above Form')
            </option>
            <option value="1" {{ old('type', $formConfirmation->type ?? 'redirect') == '1' ? 'selected' : '' }}>
                @lang('Only Message')
            </option>
            <option value="2" {{ old('type', $formConfirmation->type ?? 'reload') == '2' ? 'selected' : '' }}>
                @lang('Redirection to Another Page')
            </option>
        </select>
    </div>

    {{-- Redirect URL --}}
    <div class="col-md-6 form-group">
        <label class="form-label">@lang('Page URL')</label>
        <input type="url" name="redirect_url" class="form-control" placeholder="@lang('Enter URL...')"
            value="{{ old('redirect_url', $formConfirmation->redirect_url ?? '') }}">
    </div>

    <div class="col-md-6 form-group">
        <label class="form-label">@lang('Show Message and Redirect After')</label>
        <div class="input-group">
            <input type="number" name="redirect_delay" class="form-control" min="0"
                value="{{ old('redirect_delay', $formConfirmation->redirect_delay ?? '3') }}">
            <span class="input-group-text"
                style="border-bottom-left-radius: 0px; border-top-left-radius: 0px">@lang('seconds')</span>
        </div>
    </div>


    <div class="col-md-12 form-group">
        <input type="checkbox" id="append_submission" name="append_submission" {{ old('append_submission', $formConfirmation->append_submission ?? false) ? 'checked' : '' }}>
        <label for="append_submission">@lang('Append Submission Data to URL')</label>
    </div>
    <div class="col-md-12 form-group">
        <input type="checkbox" id="replace_field_alias" name="replace_field_alias" {{ old('replace_field_alias', $formConfirmation->replace_field_alias ?? false) ? 'checked' : '' }}>
        <label for="replace_field_alias">@lang("Replace Field Name with Field Alias when it's available")</label>
    </div>
    <div class="col-md-12 form-group">
        <input type="checkbox" id="hide_form" name="hide_form" {{ old('hide_form', $formConfirmation->hide_form ?? false) ? 'checked' : '' }}>
        <label for="hide_form">@lang('Hide Form')</label>
    </div>
    <div class="col-md-12 form-group">
        <input type="checkbox" id="custom_html" name="custom_html" {{ old('custom_html', $formConfirmation->custom_html ?? false) ? 'checked' : '' }}>
        <label for="custom_html">@lang('Custom HTML')</label>
    </div>

    {{-- Confirmation Message --}}
    <div class="col-md-12 form-group">
        <label class="form-label">@lang('Your Message')</label>
        <textarea name="message" class="form-control" rows="2"
            placeholder="@lang('Your Confirmation Message...')">{{ old('message', $formConfirmation->message ?? '') }}</textarea>
        <small class="form-text text-muted">@lang('Enter a curly bracket "{" to merge fields.')</small>
    </div>

    {{-- Conditional Logic --}}
    <div class="col-md-12 form-group">
        <label class="form-label">@lang('Show different messages with conditional logic')</label>
        <div class="border p-3 rounded bg-light mb-2">
            <strong>@lang('Conditional Logic')</strong>
            {{-- Implement your conditional logic builder here --}}
            <button type="button" class="btn btn-primary btn-sm">@lang('Add Rule')</button>
            <span
                class="text-muted ms-2">@lang('Conditional logic builder can be implemented here using JS plugin.')</span>
        </div>
    </div>
</div>


{{-- Submission Settings --}}
<div class="col-12">
    <h5 class="mt-2 border-bottom pb-1">@lang('Submission Settings')</h5>
</div>
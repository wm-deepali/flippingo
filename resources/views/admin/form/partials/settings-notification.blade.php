<div class="row g-3">

    {{-- Email To --}}
    <div class="col-md-6">
        <label class="form-label">@lang('Send To Email')</label>
        <select name="to_emails[]" class="form-select select2" multiple>
            @foreach($emails as $emailOption)
                <option value="{{ $emailOption }}" @selected(collect(old('to_emails', $formEmail->to_emails))?->contains($emailOption))>
                    {{ $emailOption }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- CC --}}
    <div class="col-md-6">
        <label class="form-label">@lang('CC')</label>
        <select name="cc_emails[]" class="form-select select2" multiple>
            @foreach($emails as $emailOption)
                <option value="{{ $emailOption }}" @selected(collect(old('cc_emails', $formEmail->cc_emails))?->contains($emailOption))>
                    {{ $emailOption }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- From Name --}}
    <div class="col-md-6">
        <label class="form-label">@lang('From Name')</label>
        <input type="text" name="from_name" class="form-control"
            value="{{ old('from_name', $formEmail->from_name ?? '') }}">
    </div>

    {{-- From Email --}}
    <div class="col-md-6">
        <label class="form-label">@lang('From Email')</label>
        <input type="email" name="from_email" class="form-control"
            value="{{ old('from_email', $formEmail->from_email ?? '') }}">
    </div>

    {{-- Email Subject --}}
    <div class="col-12">
        <label class="form-label">@lang('Subject')</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject', $formEmail->subject ?? '') }}">
    </div>

    {{-- Email Body --}}
    <div class="col-12">
        <label class="form-label">@lang('Email Message')</label>
        <textarea name="message" class="form-control"
            rows="4">{{ old('message', $formEmail->message ?? '') }}</textarea>
    </div>
</div>
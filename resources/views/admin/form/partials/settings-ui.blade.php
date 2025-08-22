<div class="row g-3">

    {{-- Theme --}}
    <div class="col-md-6">
        <label class="form-label">@lang('Theme')</label>
        <select name="theme" class="form-select">
            @foreach($themes as $key => $label)
                <option value="{{ $key }}" @selected(old('theme', $formUI->theme) == $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    {{-- Widgets --}}
    <div class="col-md-6">
        <label class="form-label">@lang('Additional UI Widgets')</label>
        <select name="ui_widgets[]" class="form-select select2" multiple>
            @foreach($uiWidgets as $widgetKey => $widgetLabel)
                <option value="{{ $widgetKey }}" @selected(collect(old('ui_widgets', $formUI->ui_widgets))->contains($widgetKey))>
                    {{ $widgetLabel }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Preview --}}
    <div class="col-12">
        <label class="form-label">@lang('Form Preview')</label>
        <div class="border bg-light p-3 rounded">
            <iframe src="" width="100%" height="300" style="border:0;"></iframe>
        </div>
    </div>
</div>
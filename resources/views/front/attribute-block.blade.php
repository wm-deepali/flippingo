<style>
    .form-control {
        border: 2px solid #e0e0e0 !important;
        color: black !important;
        border-radius: .375rem !important;
    }

    .custom-select {
        border: 2px solid #e0e0e0 !important;
        color: black !important;
        border-radius: .375rem !important;
    }
</style>


@php
    $inputType = $attribute['input_type'] ?? 'radio';
    $values = $attribute['values'] ?? [];
    $supportImage = $attribute['has_image'] ?? false;
@endphp

{{-- ========== RADIO WITH IMAGE ========== --}}
@if ($inputType === 'radio' && $supportImage)
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="{{ $attribute['id'] }}"
        data-is-required="{{ $attribute['is_required'] }}">
        <label class="form-label">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="row attribute-values">
            <div class="col-md-6">
                <div class="paper-type-section">
                    @foreach ($values as $value)
                        <button type="button"
                            class="btn btn-light print-color text-start {{ $value['is_default'] ? 'active' : '' }}"
                            data-attribute-id="{{ $attribute['id'] }}" data-value-id="{{ $value['id'] }}"
                            data-original-default="{{ $value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false' }}"
                            data-image="{{ asset('storage/' . ($value['image_path'] ?? 'default-preview.png')) }}" {{ $value['is_default'] ? 'data-selected=true' : '' }}>
                            {{ $value['value'] }}
                        </button>
                    @endforeach
                </div>
            </div>
            @php
                $imagePath = asset('storage/' . ($value['image_path'] ?? 'default-preview.png'));
            @endphp

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="border rounded overflow-hidden" style="width: 100%; height: 200px; padding: 3px;">
                    <img id="preview-image-{{ $attribute['id'] }}"
                        src="{{   asset('storage/' . ($attribute['values'][0]['image_path'] ?? 'default-preview.png'))}}"
                        class="img-fluid h-100 w-100 object-fit-cover" alt="Preview">

                    <div class="zoom-section">
                        <div class="zoomicon" data-bs-toggle="modal" data-bs-target="#imageZoomModal"
                            data-image="{{ $imagePath  }}" {{-- Add this --}} style="cursor: pointer;">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ========== PLAIN RADIO ========== --}}

@elseif ($inputType === 'radio')
    <div class="{{ in_array($attribute['name'], ['Paper Weight', 'Cover Paper Weight']) ? 'col-md-12 attribute-wrapper' : 'col-md-6 attribute-wrapper' }} mb-3"
        data-attribute-id="{{ $attribute['id'] }}" data-is-required="{{ $attribute['is_required'] }}">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-values {{ count($values) <= 4 ? 'color-print' : 'color-print1' }}">
            @foreach ($values as $value)
                <div class="print-color {{ $value['is_default'] ? 'active' : '' }}" data-attribute-id="{{ $attribute['id'] }}"
                    data-original-default="{{ $value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false' }}"
                    data-value-id="{{ $value['id'] }}" data-value="{{ $value['value'] }}">
                    <p>{{ $value['value'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ========== SELECT WITH IMAGES ========== --}}
@elseif ($inputType === 'select_image')
    <div class="attribute-wrapper col-md-12 mb-3" data-attribute-id="{{ $attribute['id'] }}"
        data-is-required="{{ $attribute['is_required'] }}">
        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>
        <div class="attribute-value color-print1">
            @foreach ($values as $value)
                <div class="choose-binding {{ $value['is_default'] ? 'active' : '' }}" data-value="{{ $value['value'] }}"
                    data-original-default="{{ $value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false' }}"
                    data-attribute-id="{{ $attribute['id'] }}" data-value-id="{{ $value['id'] }}">
                    <div>
                        <img src="{{ asset('storage/' . ($value['image_path'] ?? 'default.png')) }}" alt="{{ $value['value'] }}"
                            style="height:133px;" />
                        <div class="zoom-section1">
                            <div class="zoomicon">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </div>
                        </div>
                        <p class="text-center">{{ $value['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- ========== DROPDOWN SELECT ========== --}}
@elseif ($inputType === 'dropdown')
    <div class="attribute-wrapper col-md-6 mb-3" data-attribute-id="{{ $attribute['id'] }}"
        data-is-required="{{ $attribute['is_required'] }}">
        <div class="d-flex justify-content-between size-btn">
            <label class="form-label d-flex align-items-center" style="gap: 5px;">
                {{ $attribute['name'] }}
                <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                    data-target="#helpModal">?</span>
            </label>
            <!--<button type="button" class="btn btn-link p-0">Custom Size</button>-->
        </div>
        <div class="attribute-values">
            <select class="custom-select" id="dropdown_{{ $attribute['id'] }}" name="attributes[{{ $attribute['id'] }}]">
                <option value="">-- Select --</option>
                @foreach ($values as $value)
                    <option value="{{ $value['value'] }}" data-attribute-id="{{ $attribute['id'] }}"
                        data-original-default="{{ $value['original_is_default'] ?? ($value['is_default'] ?? false) ? 'true' : 'false' }}"
                        data-value-id="{{ $value['id'] }}" {{ $value['is_default'] ? 'selected' : '' }}>
                        {{ $value['value'] }}
                    </option>
                @endforeach
            </select>

        </div>
    </div>


    {{-- ========== SELECT AREA (LENGTH x width) ========== --}}

@elseif ($inputType === 'select_area')
    @php
        $unitLabel = match ($attribute['area_unit']) {
            'sq_feet' => 'sq ft',
            'sq_meter' => 'm²',
            default => 'sq in',
        };
    @endphp
    <div class="attribute-wrapper" data-attribute-id="{{ $attribute['id'] }}" data-attribute-type="select_area"
        data-is-required="{{ $attribute['is_required'] ? '1' : '0' }}">

        <label class="form-label d-flex align-items-center" style="gap: 5px;">
            {{ $attribute['name'] }}
            <span class="help-circle" data-label="{{ $attribute['name'] }}" data-toggle="modal"
                data-target="#helpModal">?</span>
        </label>

        <div class="row">
            <div class="col-6">
                <label for="length_{{ $attribute['id'] }}">Length ({{ $unitLabel }})</label>
                <input type="number" step="any" min="0" name="attributes[{{ $attribute['id'] }}][length]"
                    id="length_{{ $attribute['id'] }}" class="form-control area-input"
                    data-area-unit="{{ $attribute['area_unit'] }}" data-attribute-id="{{ $attribute['id'] }}"
                    @if(!empty($attribute['max_height'])) max="{{ $attribute['max_height'] }}" @endif
                    placeholder="Enter length">
                <small class="text-danger length-warning" style="display: none;">Maximum length is
                    {{ $attribute['max_height'] ?? '' }}</small>
            </div>

            <div class="col-6">
                <label for="width_{{ $attribute['id'] }}">Width ({{ $unitLabel }})</label>
                <input type="number" step="any" min="0" name="attributes[{{ $attribute['id'] }}][width]"
                    id="width_{{ $attribute['id'] }}" class="form-control area-input"
                    data-area-unit="{{ $attribute['area_unit'] }}" data-attribute-id="{{ $attribute['id'] }}"
                    @if(!empty($attribute['max_width'])) max="{{ $attribute['max_width'] }}" @endif
                    placeholder="Enter width">
                <small class="text-danger width-warning" style="display: none;">Maximum width is
                    {{ $attribute['max_width'] ?? '' }}</small>
            </div>
        </div>

        <div class="mt-2">
            <label>Calculated Area</label>
            <input type="text" id="area_{{ $attribute['id'] }}" class="form-control" readonly
                placeholder="Area will appear here">
            <small class="text-muted">Unit: {{ $unitLabel }}</small>
        </div>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.area-input').forEach(function (input) {
            input.addEventListener('input', function () {
                const max = parseFloat(input.getAttribute('max'));
                const value = parseFloat(input.value);
                const id = input.getAttribute('id');

                const warningEl = input.closest('.col-6').querySelector('small');

                if (!isNaN(max) && value > max) {
                    warningEl.style.display = 'block';
                } else {
                    warningEl.style.display = 'none';
                }
            });
        });
    });
</script>
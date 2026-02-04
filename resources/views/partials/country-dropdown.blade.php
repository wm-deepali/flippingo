@if($enableCountry)
    {{-- Country dropdown ENABLED --}}
    <div class="form-group country-field">
        <label>{{ $countryLabel ?? 'Select Country' }}</label>

        <select name="country" class="form-control">
            <option value="">
                {{ $countryLabel ?? 'Select Country' }}
            </option>

            @foreach($countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>
@else
    {{-- Country dropdown DISABLED → force India --}}
    @php
        $india = $countries->firstWhere('name', 'India');
    @endphp

    @if($india)
        <input type="hidden" name="country" value="{{ $india->id }}">
    @endif
@endif

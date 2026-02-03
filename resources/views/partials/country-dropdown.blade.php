<div class="form-group country-field" style="{{ $enableCountry ? '' : 'display:none;' }}">
    <label>Select Country</label>
    <select name="country" class="form-control">
        <option value="">Select Country</option>

        @foreach($countries as $country)
            <option value="{{ $country->id }}"
                {{ !$enableCountry && $country->name === 'India' ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mr-2">
    <label for="language_id">
        {{ $label ?? __('Language') }}
    </label>
    <select id="language_id" name="language_id">
        <option value=""></option>
        @foreach(\App\Models\Language::all() as $language)
            <option
                value="{{ $language->id }}"
                {{ old('language_id', $languageId ?? null) === $language->id ? 'selected' : '' }}
            >
                {{ $language->name }}
            </option>
        @endforeach
    </select>
    @error('language_code')
    <div class="error">
        {{ $message }}
    </div>
    @enderror
</div>

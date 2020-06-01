<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}"
            class="form-control {{ $class }} @error("$name") is-invalid @enderror"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $name }}"
            {{ $fieldAttributes ?? null }}
    >
        {{ $slot }}
    </select>
    @error("$name")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>



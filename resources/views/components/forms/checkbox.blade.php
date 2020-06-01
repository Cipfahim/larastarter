<div class="form-group">
    <div class="custom-control {{ $class }} @error("$name") is-invalid @enderror">
        <input type="checkbox"
               class="custom-control-input"
               id="{{ $name }}"
               name="{{ $name }}"
            {{ $isChecked() ? 'checked' : '' }}
            {{ $fieldAttributes ?? null }}
        >
        <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
    </div>
    @error("$name")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


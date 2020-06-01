<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}"
           id="{{ $name }}"
           class="form-control {{ $class }} @error("$name") is-invalid @enderror"
           name="{{ $name }}"
           value="{{  $value ?? old("$name") }}"
           placeholder="{{ $placeholder }}"
           autocomplete="{{ $name }}"
           {{ $fieldAttributes ?? null }}
    >
    @error("$name")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input id="{{ $name }}"
           class="dropify {{ $class }} @error("$name") is-invalid @enderror"
           name="{{ $name }}"
           data-default-file="{{  $value ?? null }}"
        {{ $fieldAttributes ?? null }}
    >
    @error("$name")
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

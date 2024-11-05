@if ($errors->first($var_name))
    <small for="{{ $var_name }}" class="help-block text-danger">{{ $errors->first($var_name) }}</small>
@endif

@props(['multiple' => false, 'value' => '', 'options' => []])
<select {{ $attributes->except(['options'])->merge([
        'class'=>'auto-init-select2',
        'data-allow-clear'=>'true',
        'data-placeholder'=>'Seleccione...',
        'multiple' => $multiple
    ]) }} >
    <option></option>
    @foreach($options as $key => $option)
        @php($selected = form_input_select_value($multiple, $key, $value, $option))
        @if((is_array($option) || is_object($option)) && !array_key_exists('id', (array)$option))
            <optgroup label="{{$key}}" data-test="$isArray?1:0">
                @foreach($option as $sKey => $sOption)
                    @php($selected = form_input_select_value($multiple, $sKey, $value))
                    {!! form_input_render_option($sKey, $selected, $sOption) !!}
                @endforeach
            </optgroup>
        @else
            {!! form_input_render_option($key, $selected, $option) !!}
        @endif
    @endforeach
</select>
@props(['multiple' => false, 'value' => '', 'options' => []])
<select {{ $attributes->except(['options'])->merge([
        'class'=>'auto-init-select2',
        'data-allow-clear'=>'true',
        'data-placeholder'=>'Seleccione...',
        'multiple' => $multiple
    ]) }} >
    <option></option>
    @foreach($options as $key => $option)
        @php($selected = form_input_select_value($multiple, $key, $value))
        @if(is_array($option) || is_object($option))
            <optgroup label="{{$key}}">
                @foreach($option as $sKey => $sOption)
                    @php($selected = form_input_select_value($multiple, $sKey, $value))
                    <option value="{{$sKey}}" {{  $selected ? 'selected' :'' }}>{{$sOption}}</option>
                @endforeach
            </optgroup>
        @else
            <option value="{{$key}}" {{  $selected ? 'selected' :'' }}>{{$option}}</option>
        @endif
    @endforeach
</select>
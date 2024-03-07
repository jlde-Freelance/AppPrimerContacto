@props(['disabled' => false,'attr'=> []])
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(array_merge(['class'=>'prc-input-file-simple'], $attr)) !!}>
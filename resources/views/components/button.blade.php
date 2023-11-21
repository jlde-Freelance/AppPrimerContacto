@props(['link' => false, 'secondary' => false])
@php( $attr = $attributes->class([ 'prc-button', 'prc-button-secondary' => $secondary ]) )
@if($link)
    <a {{ $attr }}>{{$slot}}</a>
@else
    <button {{ $attr }}>{{$slot}}</button>
@endif

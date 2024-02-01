@props(['label','name','type'=>'input'])
@php($required = $attributes->get('required', false))

<div class="prc-input-group">
    <x-forms.input-label :for="$name" :value="$label" :required="$required"/>
    @switch($type)
        @case('password')
        @case('input')
            <x-forms.input-text :id="$name" :name="$name" :type="$type" {{ $attributes }} />
            @break
        @case('select')
            <x-forms.input-select :id="$name" :name="$name" {{ $attributes }}/>
            @break
    @endswitch
    <x-forms.input-error :messages="$errors->get($name)" class="mt-2"/>
</div>
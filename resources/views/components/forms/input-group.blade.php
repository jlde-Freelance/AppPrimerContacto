@props(['label','name', 'id','type'=>'input'])
@php($required = $attributes->get('required', false))

<div class="prc-input-group">
    <x-forms.input-label :for="$name" :value="$label" :required="$required"/>
    @switch($type)
        @case('password')
        @case('input')
        @case('number')
            <x-forms.input-text :id="$id ?? $name" :name="$name" :type="$type" {{ $attributes }} />
            @break
        @case('file')
            <x-forms.input-file :id="$id ?? $name" :name="$name" :type="$type" {{ $attributes }} />
            @break
        @case('file-zone')
            <x-forms.input-file-zone :id="$id ?? $name" :name="$name" {{ $attributes }}/>
            @break
        @case('select')
            <x-forms.input-select :id="$name" :name="$name" {{ $attributes }}/>
            @break
        @case('textarea')
            <x-forms.input-textarea :id="$name" :name="$name" {{ $attributes }}/>
            @break
        @case('range')
            <x-forms.input-range :id="$id ?? $name" :name="$name" {{ $attributes }}/>
            @break
    @endswitch
    <x-forms.input-error :messages="$errors->get($name)" class="mt-2"/>
</div>

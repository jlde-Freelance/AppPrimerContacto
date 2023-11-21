@props(['value','required' => false])
<label {{ $attributes->merge(['class'=>'prc-label'])}}>
    {{ $value ?? $slot }}
    @if($required) <span class="text-red-500">*</span> @endif
</label>
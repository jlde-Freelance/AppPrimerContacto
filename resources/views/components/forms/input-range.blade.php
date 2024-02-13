@props(['label','name', 'id','type'=>'input'])

<div class="flex">
    <x-forms.input-text :id="$id ?? $name.'_min'" :name="$name.'_min'" :type="$type" {{ $attributes }}
                        class="rounded-none -ms-0.5 rounded-l-md"
                        placeholder="# Desde"/>
    <x-forms.input-text :id="$id ?? $name.'_max'" :name="$name.'_max'" :type="$type" {{ $attributes }}
                        class="rounded-none -ms-0.5 rounded-r-md"
                        placeholder="# Hasta"/>
</div>

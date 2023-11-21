<div class="flex items-center mr-2 mb-2">
    <input {{ $attributes->merge(['type'=>'checkbox','class'=>'prc-checkbox']) }}>
    <label for="red-checkbox" class="ml-2 text-ba">{{$slot}}</label>
</div>
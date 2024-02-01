@props([ 'links', 'bodies'])
@php($uuid = Illuminate\Support\Str::uuid())
<div class="border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center md:justify-start" data-tabs-toggle="#{{$uuid}}" role="tablist">
        {{ $links }}
    </ul>
</div>
<div id="{{$uuid}}">
    {{ $bodies }}
</div>
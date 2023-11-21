@php
    $uuid = Str::uuid();
    $active = isset($path) && str_contains(request()->path(), $path);
@endphp
<li>
    <button type="button" class="prc-sidebar-link w-full" data-collapse-toggle="{{$uuid}}" aria-expanded="{{$active?'true':'false'}}">
        @if(isset($icon)) <i class="bi bi-{{$icon}} mr-3"></i> @endif
        <span class="flex-1 text-left whitespace-nowrap">{{$label}}</span>
        <i class="bi bi-chevron-down mr-3" width="20"></i>
    </button>
    <ul id="{{$uuid}}" @class(['py-2 space-y-2 pl-8','hidden' => !$active])>
        {{$slot}}
    </ul>
</li>
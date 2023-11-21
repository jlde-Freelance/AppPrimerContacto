@php
    $href = $to ?? 'javascript:void(0);';
    $active = isset($to) && str_ends_with($to, request()->path());
@endphp
<li>
    <a href="{{$href}}" {{ $attributes->except(['to','icon','label'])->merge(['class'=> 'prc-sidebar-link '])->class(['active' => $active]) }}>
        @if(isset($icon)) <i class="bi bi-{{$icon}} mr-3"></i> @endif
        <span>{{$label ?? $slot}}</span>
    </a>
</li>
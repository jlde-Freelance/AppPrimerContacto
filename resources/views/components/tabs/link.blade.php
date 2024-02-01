@props([ 'id' ])
<li class="mr-2 px-3" role="presentation">
    <a class="prc-link text-blue-green font-bold border-b-4 border-blue-green pb-3 flex items-center gap-2 dark:border-transparent dark:hover:border-vegas-gold"
       id="tab-{{$id}}" data-tabs-target="#{{$id}}" role="tab" aria-controls="{{$id}}" aria-selected="false">
        {{$slot}}
    </a>
</li>
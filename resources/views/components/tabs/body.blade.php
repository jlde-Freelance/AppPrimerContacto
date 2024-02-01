@props([ 'id' ])
<div class="hidden py-4" id="{{$id}}" role="tabpanel" aria-labelledby="{{$id}}">
    {{$slot}}
</div>
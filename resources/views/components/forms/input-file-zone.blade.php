@props(['id','value'])
<div class="prc-input-file-group">
    <div class="flex w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 overflow-auto">
        <label for="{{$id}}" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-8 gap-2 w-full p-2 cursor-pointer {{$value ? '':'hidden'}}">
            @foreach($value as $oldImg)
            <img src="{{$oldImg}}" class="h-auto max-w-full rounded-lg cursor-no-drop old-img" alt="{{ basename($oldImg) }}" onclick="removeImage(event)">
            <input type="text" hidden name="images_old[]" value="{{ basename($oldImg) }}">
            @endforeach
        </label>
        <label for="{{$id}}" class="flex items-center justify-center flex-col w-full cursor-pointer {{$value ? 'hidden':''}}">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                </svg>
             <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haga clic para cargar</span>{{-- o arrastrar y soltar --}}</p>
                <p class="text-xs text-gray-500">JPG, JPEG o PNG (MAX. 800x800px)</p>
            </div>
            <input {{ $attributes->merge(['type'=>'file', 'class' => 'hidden prc-input-file','id'=>$id]) }} />
        </label>
    </div>
    <small class="prc-input-file-errors text-red-600"></small>
</div>

@php use App\Models\ResourceFile; @endphp
<div class="grid grid-cols-1 gap-3">

    <div class="grid grid-cols-2">

        <x-forms.input-group type="file" name="image_primary"
                             :label="__('Imagen Principal')"
                             allow-format="image/jpeg,image/jpg,image/png"/>

        <div class="p-3 flex justify-center">
            @php($src =  isset($model) ? $model->getImagePrimary(ResourceFile::IMG_SIZE_MEDIUM) : asset('img/default_image.jpg'))
            <img class="max-h-[200px] rounded-2xl" id="preview-image_primary" src="{{$src}}" alt="Imagen Principal"/>
        </div>
    </div>


    <x-forms.input-group type="file-zone" id="images" name="images[]"
                         :label="__('Imágenes Alternativas')"
                         :value="isset($model) ? $model->getImages(ResourceFile::IMG_SIZE_MEDIUM) : []"
                         maxlength="10"
                         allow-format="image/jpeg,image/jpg,image/png"
                         multiple/>

    <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>

</div>

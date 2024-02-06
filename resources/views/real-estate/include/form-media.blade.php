<div class="grid grid-cols-1 gap-3">

    <x-forms.input-group type="file" name="image"
                         :label="__('Imagen Principal')"
                         :value="isset($model) ? $model->getImage('medium') : null"
                         allow-format="image/jpeg,image/jpg,image/png"/>

    <x-forms.input-group type="file-zone" id="images" name="images[]"
                         :label="__('Imágenes Alternativas')"
                         :value="isset($model) ? $model->getImages('medium') : []"
                         maxlength="10"
                         allow-format="image/jpeg,image/jpg,image/png"
                         multiple/>

    <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>

</div>

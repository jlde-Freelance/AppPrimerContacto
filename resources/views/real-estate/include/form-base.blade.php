@php use \App\Types\MasterOptionsType; @endphp
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

    <x-forms.input-group name="code" :label="__('Código')"
                         value="{{ $model->code ?? $newCode }}"
                         maxlength="10"
                         readonly/>

    <x-forms.input-group type="select" name="type_id"
                         :label="__('Tipo de inmueble')"
                         value="{{$model->type_id ?? ''}}" required
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE->name]"/>

    <x-forms.input-group type="select" name="action_id"
                         :label="__('Acción')"
                         value="{{$model->action_id ?? ''}}" required
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE_ACTION->name]"/>

    <x-forms.input-group name="sale_value" :label="__('Valor Venta')"
                         data-inputmask="'alias': 'currency'"
                         value="{{$model->sale_value ?? ''}}"
                         depends_of="action_id:27,29"/>

    <x-forms.input-group name="rental_value" :label="__('Valor Arriendo')"
                         data-inputmask="'alias': 'currency'"
                         value="{{$model->rental_value ?? ''}}"
                         depends_of="action_id:28,29"/>

    <x-forms.input-group type="select" name="unit_id"
                         :label="__('Unidad residencial')"
                         :options="isset($model->unit_id) ? [$model->unit_id => $model->unit->name] : []"
                         value="{{  $model->unit_id ?? ''}}"
                         data-ajax-url="{{ route('residential-units.select2ajax') }}"
                         data-ajax-dataType="json"/>

    <x-forms.input-group name="house_level" :label="__('Cuantos Pisos')" maxlength="30"
                         value="{{ $model->house_level ?? '' }}"/>

    <x-forms.input-group name="apartment_level" :label="__('Piso')"  maxlength="30"
                         value="{{ $model->apartment_level ?? '' }}"/>

    <x-forms.input-group name="bedrooms" :label="__('Habitaciones')"  maxlength="30"
                         value="{{ $model->bedrooms ?? '' }}"/>

    <x-forms.input-group name="bathrooms" :label="__('Baños')"  maxlength="30"
                         value="{{ $model->bathrooms ?? '' }}"/>

    <x-forms.input-group name="parking" :label="__('Parqueadero')"  maxlength="30"
                         value="{{ $model->parking ?? '' }}"/>

    <x-forms.input-group name="total_area" :label="__('Área total')"  maxlength="30"
                         value="{{ $model->total_area ?? '' }}"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group name="built_area" :label="__('Área construida')"  maxlength="30"
                         value="{{ $model->built_area ?? '' }}"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group name="apartment_area" :label="__('Área apartamento')"  maxlength="30"
                         value="{{ $model->apartment_area ?? '' }}"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group name="year_of_remodeling" :label="__('Año de remodelado')"  maxlength="30"
                         value="{{ $model->year_of_remodeling ?? '' }}"/>

    <x-forms.input-group name="administration" :label="__('Administración')" maxlength="30"
                         value="{{ $model->administration ?? '' }}"/>

    <x-forms.input-group type="select" name="status"
                         :label="__('Estado')"
                         value="1" required
                         :options="[1=>'Activo',0 =>'Inactivo']"/>

    <div class="md:col-span-2">
        <x-forms.input-group type="select" name="specifications[]"
                             :label="ucfirst(__('validation.attributes.specifications'))"
                             :value="isset($model) ? $model->specifications : []"
                             :multiple="true"
                             :options="$Options[MasterOptionsType::TYPE_SPECIFICATIONS->name]->toArray()"/>
    </div>

    <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>

</div>

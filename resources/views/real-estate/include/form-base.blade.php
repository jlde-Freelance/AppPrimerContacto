@php use \App\Types\MasterOptionsType; use App\Models\ResidentialUnits; @endphp
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
                         data-minimum-results-for-search="Infinity"
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE_ACTION->name]"/>

    <x-forms.input-group name="sale_value" :label="__('Valor Venta')"
                         data-inputmask="'alias': 'currency'"
                         value="{{$model->sale_value ?? ''}}"
                         depends_of="action_id:27,29"/>

    <x-forms.input-group name="rental_value" :label="__('Valor Arriendo')"
                         data-inputmask="'alias': 'currency'"
                         value="{{$model->rental_value ?? ''}}"
                         depends_of="action_id:28,29"/>

    @php($OptionsUnitIds = $Options[ResidentialUnits::TYPE_RESIDENTIAL_UNITS_OPTIONS])
    @if($OptionsUnitIds)
        <x-forms.input-group type="select" name="unit_id"
                             :label="__('Unidad residencial')"
                             value="{{$model->unit_id ?? ''}}"
                             :data-minimum-results-for-search="count($OptionsUnitIds) > 5 ? 3:'Infinity'"
                             :options="$OptionsUnitIds"/>
    @else
        <x-forms.input-group type="select" name="unit_id"
                             :label="__('Unidad residencial')"
                             :options="$OptionsUnitIds"
                             value="{{  $model->unit_id ?? ''}}"
                             data-ajax-url="{{ route('residential-units.select2ajax') }}"
                             data-ajax-dataType="json"/>
    @endif

    <x-forms.input-group name="house_level" type="number" :label="__('Cuantos Pisos')" maxlength="30"
                         value="{{ $model->house_level ?? '' }}"/>

    <x-forms.input-group name="apartment_level" type="number" :label="__('Piso')"  maxlength="30"
                         value="{{ $model->apartment_level ?? '' }}"/>

    <x-forms.input-group name="bedrooms" type="number" :label="__('Habitaciones')"  maxlength="30"
                         value="{{ $model->bedrooms ?? '' }}"/>

    <x-forms.input-group name="bathrooms" type="number" :label="__('Baños')"  maxlength="30"
                         value="{{ $model->bathrooms ?? '' }}"/>

    <x-forms.input-group name="parking" type="number" :label="__('Parqueadero')"  maxlength="30"
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

    <x-forms.input-group name="year_of_remodeling" type="number" :label="__('Año de remodelado')"  maxlength="30"
                         value="{{ $model->year_of_remodeling ?? '' }}"/>

    <x-forms.input-group name="administration" :label="__('Administración')" maxlength="30"
                         data-inputmask="'alias': 'currency'"
                         value="{{ $model->administration ?? '' }}"/>

    <x-forms.input-group type="select" name="status" required
                         :label="__('Estado')"
                         data-allow-clear="false"
                         value="{{ isset($model) ? $model->status : '1' }}"
                         :options="[1=>'Activo',0 =>'Inactivo']"/>

    <div class="md:col-span-2">
        <x-forms.input-group type="select" name="specifications[]"
                             :label="ucfirst(__('validation.attributes.specifications'))"
                             :value="isset($model) ? $model->specifications : []"
                             :multiple="true"
                             :options="$Options[MasterOptionsType::TYPE_SPECIFICATIONS->name]->toArray()"/>
    </div>


    <div class="md:col-span-3">
        <hr>
        <x-forms.input-group type="textarea" name="description" :label="__('Descripción')"  maxlength="2000"
                             value="{{ $model->description ?? '' }}"/>
    </div>
    <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>

</div>

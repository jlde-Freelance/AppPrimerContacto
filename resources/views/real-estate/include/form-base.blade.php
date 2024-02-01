@php
    use \App\Types\MasterOptionsType;
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

    <x-forms.input-group name="code" :label="__('Código')"
                         value="{{ $RealEstate->code ?? $newCode }}"
                         readonly />

    <x-forms.input-group type="select" name="type_id"
                         :label="__('Tipo de inmueble')"
                         value="{{$RealEstate->type_id ?? ''}}" required
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE->name]"/>

    <x-forms.input-group type="select" name="action_id"
                         :label="__('Acción')"
                         value="{{$RealEstate->action_id ?? ''}}" required
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE_ACTION->name]"/>

    <x-forms.input-group name="sale_value" :label="__('Valor Venta')"
                         data-inputmask="'alias': 'currency'"
                         value="{{$RealEstate->sale_value ?? ''}}"
                         depends_of="action_id:27,29" />

    <x-forms.input-group name="rental_value" :label="__('Valor Arriendo')"
                         data-inputmask="'alias': 'currency'"
                         value="{{$RealEstate->rental_value ?? ''}}"
                         depends_of="action_id:28,29" />

    <x-forms.input-group type="select" name="unit_id"
                         :label="__('Unidad residencial')"
                         :options="isset($RealEstate->unit_id) ? [$RealEstate->unit_id => $RealEstate->unit->name] : []"
                         value="{{  $RealEstate->unit_id ?? ''}}"
                         data-ajax-url="{{ route('residential-units.select2ajax') }}"
                         data-ajax-dataType="json"/>

    <x-forms.input-group name="house_level" :label="__('Cuantos Pisos')"
                         value="{{ $RealEstate->house_level ?? '' }}"
                         />

    <x-forms.input-group name="apartment_level" :label="__('Piso')"
                         value="{{ $RealEstate->apartment_level ?? '' }}"
                         />

    <x-forms.input-group name="bedrooms" :label="__('Habitaciones')"
                         value="{{ $RealEstate->bedrooms ?? '' }}"
                         />

    <x-forms.input-group name="bathrooms" :label="__('Baños')"
                         value="{{ $RealEstate->bathrooms ?? '' }}"
                         />

    <x-forms.input-group name="parking" :label="__('Parqueadero')"
                         value="{{ $RealEstate->parking ?? '' }}"
                         />

    <x-forms.input-group name="total_area" :label="__('Área total')"
                         value="{{ $RealEstate->total_area ?? '' }}"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group name="built_area" :label="__('Área construida')"
                         value="{{ $RealEstate->built_area ?? '' }}"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group name="apartment_area" :label="__('Área apartamento')"
                         value="{{ $RealEstate->apartment_area ?? '' }}"
                        data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group name="year_of_remodeling" :label="__('Año de remodelado')"
                         value="{{ $RealEstate->year_of_remodeling ?? '' }}"
                         />

    <x-forms.input-group name="administration" :label="__('Administración')"
                         value="{{ $RealEstate->administration ?? '' }}"
                         />

    <x-forms.input-group type="select" name="status"
                         :label="__('Estado')"
                         value="1" required
                         :options="[1=>'Activo',0 =>'Inactivo']"/>

    <div class="md:col-span-2 py-2">
        <x-forms.input-group type="select" name="specifications[]"
                             :label="ucfirst(__('validation.attributes.specifications'))"
                             :value="isset($RealEstate) ? $RealEstate->specifications : []"
                             :multiple="true"
                             :options="$Options[MasterOptionsType::TYPE_SPECIFICATIONS->name]->toArray()"/>
    </div>

    <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>


</div>

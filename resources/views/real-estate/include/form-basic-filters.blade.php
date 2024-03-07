@php use \App\Types\MasterOptionsType; @endphp
@php use App\Models\Location; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3">

    <x-forms.input-group type="select" name="status"
                         :label="__('Estado')"
                         :options="[1=>'Activo',0 =>'Inactivo']"/>

    <x-forms.input-group type="select" name="action_id"
                         :label="__('Gestión')"
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE_ACTION->name]"/>

    <div class="col-span-2">
        <x-forms.input-group type="select" name="location_id"
                             :label="__('Ciudad')"
                             :options="$Options[Location::TYPE_LOCATION_OPTIONS]"/>
    </div>

    <x-forms.input-group type="select" name="type_id"
                         :label="__('Tipo de inmueble')"
                         :options="$Options[MasterOptionsType::TYPE_REAL_ESTATE->name]"/>

    <div class="col-span-2">
        <x-forms.input-group type="select" name="unit_id"
                             :label="__('Unidad residencial')"
                             :options="isset($model->unit_id) ? [$model->unit_id => $model->unit->name] : []"
                             value="{{  $model->unit_id ?? ''}}"
                             data-ajax-url="{{ route('residential-units.select2ajax') }}"
                             data-ajax-dataType="json"/>
    </div>

    <x-forms.input-group name="code" :label="__('Código')"
                         maxlength="6"
                         data-inputmask="'alias': 'numeric', 'removeMaskOnSubmit': true, 'stripLeadingZeroes': false, 'placeholder': '', 'prefix': '#', 'rightAlign': false"/>

</div>

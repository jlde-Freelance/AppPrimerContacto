@php use \App\Types\MasterOptionsType; @endphp
@php use App\Models\Location; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

    <x-forms.input-group type="range" name="sale_value" :label="__('Valor Venta')" data-inputmask="'alias': 'currency'"/>

    <x-forms.input-group type="range" name="rental_value" :label="__('Valor Arriendo')" data-inputmask="'alias': 'currency'"/>

    <x-forms.input-group type="range" name="administration" :label="__('Administración')" maxlength="30"
                         data-inputmask="'alias': 'currency'"/>

    <x-forms.input-group type="range" name="bathrooms" :label="__('Baños')"/>

    <x-forms.input-group type="range" name="bedrooms" :label="__('Habitaciones')"/>

    <x-forms.input-group type="range" name="apartment_level" :label="__('Pisos/Niveles')"/>

    <x-forms.input-group type="range" name="parking" :label="__('Parqueadero')" maxlength="30"/>

    <x-forms.input-group type="range" name="total_area" :label="__('Área total')" maxlength="30"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group type="range" name="built_area" :label="__('Área construida')" maxlength="30"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group type="range" name="apartment_area" :label="__('Área apartamento')" maxlength="30"
                         data-inputmask="'mask': '9{1,9} mt²'"/>

    <x-forms.input-group type="range" name="year_of_remodeling" :label="__('Año de remodelado')" maxlength="30"/>

    <x-forms.input-group type="select" name="specifications[]"
                         :label="ucfirst(__('validation.attributes.specifications'))"
                         :value="[]"
                         :multiple="true"
                         :options="$Options[MasterOptionsType::TYPE_SPECIFICATIONS->name]->toArray()"/>

</div>

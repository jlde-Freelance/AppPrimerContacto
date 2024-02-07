@php use App\Models\Location; @endphp
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

    <x-forms.input-group name="address" :label="__('Dirección')" maxlength="200"
                         value="{{ $model->address ?? '' }}"/>

    <x-forms.input-group type="select" name="location_id"
                         :label="__('Localización')"
                         value="{{$model->location_id ?? ''}}"
                         :options="$Options[Location::TYPE_LOCATION_OPTIONS]"/>

    <div class="md:col-span-3 py-2">
        <div id="map" style="height: 400px; width: 100%; cursor: crosshair;"></div>
    </div>

    <x-forms.input-group name="latitude" :label="__('Latitud')" maxlength="30"
                         value="{{ $model->latitude ?? '' }}" readonly/>

    <x-forms.input-group name="longitude" :label="__('Longitud')" maxlength="30"
                         value="{{ $model->longitude ?? '' }}" readonly/>

    <x-forms.input-error class="md:col-span-2 py-2" :messages="$errors->get('default')"/>

</div>
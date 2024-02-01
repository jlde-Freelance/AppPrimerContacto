@php
    use App\Models\Location;
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">

    <x-forms.input-group name="address" :label="__('Dirección')" maxlength="200"
                         value="{{ $RealEstate->address ?? '' }}"/>

    <x-forms.input-group type="select" name="location_id"
                         :label="__('Localización')"
                         value="{{$RealEstate->location_id ?? ''}}" required
                         :options="$Options[Location::TYPE_LOCATION_OPTIONS]"/>

    <div class="md:col-span-3 py-2">
        <div id="map" style="height: 400px; width: 100%; cursor: crosshair;"></div>
        <script type="text/javascript">
            // Wait for the document to be ready
            document.addEventListener('DOMContentLoaded', function () {

                // Create a map instance and set the initial view coordinates and zoom level
                const leafletMap = L.map('map').setView([6.2428056, -75.588572], 15);

                // Add a tile layer to the map from OpenStreetMap
                L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(leafletMap);

                /**
                 * Cuando se usa el mapa dentro de un tab, se adiciona el siguiente código para ajustar el tamaño al cargar el tab
                 * @type {HTMLElement}
                 */
                const menuItem = document.getElementById('tab-info-admin');
                (new MutationObserver(() => (menuItem.style.display !== 'none' && leafletMap.invalidateSize()))).observe(menuItem, {attributes: true});

                leafletMap.on('click', ({latlng}) => {
                    const KEY_MARKER = 'real-estate-merker';
                    if(window[KEY_MARKER]) window[KEY_MARKER].remove();
                    document.getElementById('latitude').value = latlng.lat;
                    document.getElementById('longitude').value = latlng.lng;
                    window[KEY_MARKER] = L.marker([latlng.lat, latlng.lng]);
                    window[KEY_MARKER].addTo(leafletMap);
                })

            });
        </script>
    </div>

    <x-forms.input-group name="latitude" :label="__('Latitud')" maxlength="30"
                         value="{{ $RealEstate->latitude ?? '' }}" readonly/>

    <x-forms.input-group name="longitude" :label="__('Longitud')" maxlength="30"
                         value="{{ $RealEstate->longitude ?? '' }}" readonly/>
</div>
/**
 * loadScriptFormRealStateCreate
 */
export default function loadScriptFormRealState() {

    const initLeaflet = () => {

        const inputLatitude = document.getElementById('latitude')
        const inputLongitude = document.getElementById('longitude')
        const leafletMap = L.map('map').setView([inputLatitude.value || '6.2428056', inputLongitude.value || '-75.588572'], (inputLatitude.value ? 16 : 14));

        L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);

        const loadMarker = (latitude, longitude) => {
            const KEY_MARKER = 'real-estate-merker';
            if (window[KEY_MARKER]) window[KEY_MARKER].remove();
            inputLatitude.value = latitude;
            inputLongitude.value = longitude;
            window[KEY_MARKER] = L.marker([latitude, longitude]);
            window[KEY_MARKER].addTo(leafletMap);
        }

        /**
         * Cuando se usa el mapa dentro de un tab, se adiciona el siguiente código para ajustar el tamaño al cargar el tab
         * @type {HTMLElement}
         */
        const menuItem = document.getElementById('tab-info-admin');
        (new MutationObserver(() => (menuItem.style.display !== 'none' && leafletMap.invalidateSize()))).observe(menuItem, {attributes: true});

        if (inputLatitude.value && inputLongitude.value) loadMarker(inputLatitude.value, inputLongitude.value);
        leafletMap.on('click', ({latlng}) => loadMarker(latlng.lat, latlng.lng))

    }

    const intiEventImagePrimary = () => {
        document.getElementById('image_primary').addEventListener('change', (e) => {
            const [file] = e.target.files
            if (file) {
                document.getElementById('preview-image_primary').src = URL.createObjectURL(file)
            }
        })
    }

    initLeaflet();
    intiEventImagePrimary();

}
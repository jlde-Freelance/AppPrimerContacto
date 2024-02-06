/**
 * loadScriptFormRealStateCreate
 */
export default function loadScriptFormRealStateCreate() {

    const initLeaflet = () => {

        const leafletMap = L.map('map').setView([6.2428056, -75.588572], 15);

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
            if (window[KEY_MARKER]) window[KEY_MARKER].remove();
            document.getElementById('latitude').value = latlng.lat;
            document.getElementById('longitude').value = latlng.lng;
            window[KEY_MARKER] = L.marker([latlng.lat, latlng.lng]);
            window[KEY_MARKER].addTo(leafletMap);
        })

    }

    initLeaflet();

}
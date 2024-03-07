/**
 */
const loadViewRealEstateIndex = () => {

    const mapHouseIcon = L.icon({
        iconUrl: 'img/house_location_home_map_pin.png',
        iconSize: [40, 40], // size of the icon
        popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
    });

    const C = (value) => (currency(value, {separator: '.', precision: 0, pattern: `! #`}).format())
    let stored;

    const initDataTable = (filters = null) => {

        if (stored) stored.destroy();

        stored = $('#datatable-real-estate-index').DataTable({
            language: {url: `${route().t.url}/dt-es-co.json`},
            stateSave: true,
            responsive: true,
            ajax: {
                url: route('real-estate.index'),
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
                    return {start: d.start, length: d.length, filters: filters};
                }
            },
            processing: true,
            serverSide: true,
            columns: [
                {
                    data: function (row) {
                        const defaultImage = `${route().t.url}/img/image_default.jpeg`
                        const _src = row.image || defaultImage;
                        return `<figure class="max-w-lg">
                              <img class="h-auto max-w-[100px] rounded-lg" src="${_src}" onerror="if (this.src != '${defaultImage}') this.src = '${defaultImage}';" alt="image description">
                              <figcaption class="mt-2 text-xs text-center text-gray-500 dark:text-gray-400">#${row.code}</figcaption>
                            </figure>`
                    }
                },
                {
                    data: function (row) {
                        const neighborhood = row.metadata?.find(x => x.key === 'neighborhood')?.value || '';
                        return `
                            <div>
                                <div class="text-balance text-lg font-bold text-blue-green">${row.type}</div>
                                <div>${row.location?.department_name || ''}</div>
                                <div>${row.location?.municipality_name || ''}</div>
                                <div>${neighborhood}</div>
                            </div>
                        </div>
                    `
                    }
                },
                {
                    data: function (row) {
                        const prices = [];
                        if (row.sale_value && [27, 29].includes(row.action_id)) prices.push(C(row.sale_value));
                        if (row.rental_value && [28, 29].includes(row.action_id)) prices.push(C(row.rental_value));
                        return `
                        <div class="text-lg font-bold text-blue-green">${row.action}</div>
                        <div>${prices.join(' - ')}</div>
                    `
                    }
                },
                {
                    data: function (row) {
                        return `
                        ${row.bedrooms ? `<div><strong>Habitaciones:</strong> ${row.bedrooms}</div>` : ''}
                        ${row.bathrooms ? `<div><strong>Baños:</strong> ${row.bathrooms}</div>` : ''}
                    `
                    }
                },
                {
                    data: function (row) {
                        return `<span class="prc-status status-value-${row.status}">${+row.status ? 'Activo' : 'Inactivo'}</span>`
                    }
                },
                {
                    data: function (row) {
                        return `
                        <div class="flex flex-row gap-4">
                            <div x-data="{ open: false,
                                          toggle() {
                                            if (this.open) {
                                                return this.close()
                                            }
                                            this.$refs.button.focus()
                                            this.open = true
                                          },
                                          close(focusAfter) {
                                            if (! this.open) return
                                                this.open = false
                                                focusAfter && focusAfter.focus()
                                            }
                                    }"
                                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                    x-id="['dropdown-button']" class="relative">
                                <!-- Dropdown toggle button -->
                                <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                        :aria-controls="$id('dropdown-button')" class="inline-flex items-center p-2 text-base font-medium text-center text-gray-900 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <!-- Dropdown list -->
                                <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                                     :id="$id('dropdown-button')" class="absolute z-10 right-0 py-2 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                     <a href="${route('real-estate.update', row.id)}" class="block text-start px-4 py-2 text-blue-green font-bold cursor-pointer hover:bg-gray-400 hover:text-white">
                                        <i class="bi bi-pencil w-4 h-4 mr-2"></i>
                                        Editar
                                    </a>
                                    <a href="${route('real-estate.destroy', row.id)}" class="block text-start px-4 py-2 text-red-600 font-bold cursor-pointer hover:bg-gray-400 hover:text-white" data-confirm-delete="true">
                                        <i class="bi bi-trash w-4 h-4 mr-2"></i>
                                        Eliminar
                                    </a>
                                </div>
                            </div>
                            <div x-data="{ open: false,
                                          toggle() {
                                            if (this.open) {
                                                return this.close()
                                            }
                                            this.$refs.button.focus()
                                            this.open = true
                                          },
                                          close(focusAfter) {
                                            if (! this.open) return
                                                this.open = false
                                                focusAfter && focusAfter.focus()
                                            }
                                    }"
                                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                    x-id="['dropdown-button']" class="relative">
                                <!-- Dropdown toggle button -->
                                <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                        :aria-controls="$id('dropdown-button')" class="inline-flex items-center p-2 text-base font-medium text-center text-gray-900 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50">
                                    <i class="bi bi-share"></i>
                                </button>
                                <!-- Dropdown list -->
                                <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                                     :id="$id('dropdown-button')" class="absolute z-10 right-0 py-2 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <a href="${route('real-estate.detail', row.uuid)}" target="_blank" class="block text-start px-4 py-2 text-gray-700 font-bold cursor-pointer hover:bg-gray-400 hover:text-white">
                                        <i class="bi bi-person-vcard w-4 h-4 mr-2"></i>
                                        Ficha
                                    </a>
                                     <a href="${route('real-estate.index', row.uuid)}" target="_blank" class="block text-start px-4 py-2 text-gray-700 font-bold cursor-pointer hover:bg-gray-400 hover:text-white">
                                        <i class="bi bi-postcard w-4 h-4 mr-2"></i>
                                        Ficha sin contacto
                                    </a>
                                </div>
                            </div>
                        </div>
                    `
                    }
                }
            ],
            searching: false,
            ordering: false
        });
    }

    const initLeaflet = () => {

        const leafletMap = L.map('map').setView([6.2428056, -75.588572], 15);

        L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);

        let markers = L.markerClusterGroup();

        $.ajax({
            url: route("real-estate.index"),
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function ({data}) {
                $.each(data, function (index, {location, latitude, longitude, ...data}) {
                    var popupContent = `
                        <div>
                            <b>${data.type}</b><br>
                            <span>${data.action}</span><br>
                            ${ location ? `<b>${location.department_name}</b> ${location.municipality_name}`: ''}
                        </div>
                    `;
                    // Añade el marcador al grupo de marcadores en lugar de al mapa directamente
                    var marker = L.marker([latitude, longitude], {icon: mapHouseIcon}).bindPopup(popupContent);
                    markers.addLayer(marker);
                });
                // Añade el grupo de marcadores al mapa
                leafletMap.addLayer(markers);
            }
        });

        /**
         * Cuando se usa el mapa dentro de un tab, se adiciona el siguiente código para ajustar el tamaño al cargar el tab
         * @type {HTMLElement}
         */
        const menuItem = document.getElementById('tab-real-estate-map');
        (new MutationObserver(() => (menuItem.style.display !== 'none' && leafletMap.invalidateSize()))).observe(menuItem, {attributes: true});
    }

    $('#filter-datatable-real-estate-index').submit((e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const specifications = formData.getAll('specifications[]');
        const filters = _.fromPairs(Array.from(formData.entries()));
        filters.specifications = specifications;
        initDataTable(_.omit(filters, ['_token', 'specifications[]']));
    });

    $('#tab-real-estate-map').click(() => initLeaflet());

    initDataTable();
}

export default loadViewRealEstateIndex

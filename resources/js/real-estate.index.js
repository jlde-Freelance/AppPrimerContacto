/**
 */
const loadViewRealEstateIndex = () => {

    const C = (value) => (currency(value, {separator: '.', precision: 0, pattern: `! #`}).format())

    $('#datatable-real-estate-index').DataTable({
        language: {url: `${route().t.url}/dt-es-co.json`},
        stateSave: true,
        responsive: true,
        ajax: {
            url: route('real-estate.index'),
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {
                return {start: d.start, length: d.length};
            }
        },
        processing: true,
        serverSide: true,
        columns: [
            {
                data: function (row) {
                    const neighborhood = row.metadata?.find(x => x.key === 'neighborhood')?.value || '';
                    return `
                        <div class="flex items-center gap-2 flex-col md:flex-row">
                            <img class="rounded-md" src="${row.images.at(0)}" alt="${row.code} - ${row.type}">
                            <div>
                                <div class="text-lg font-bold text-blue-green"> # ${row.code} - ${row.type}</div>
                                <div>${row.location?.department_name || ''} - ${row.location?.municipality_name || ''}</div>
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
                className: 'text-center',
                data: function (row) {
                    return `
                        <a href="${route('real-estate.update', row.id)}" class="text-blue-green font-bold cursor-pointer">
                            Editar
                        </a>
                        <a href="${route('real-estate.destroy', row.id)}" class="text-red-600 font-bold cursor-pointer mx-2" data-confirm-delete="true">
                            Eliminar
                        </a>
                        <a href="${route('real-estate.index', row.uuid)}" target="_blank" class="text-gray-700 font-bold cursor-pointer">
                            Ficha
                        </a>
                    `
                }
            }
        ],
        searching: false,
        ordering: false
    });

}

export default loadViewRealEstateIndex
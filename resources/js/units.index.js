/**
 * Script loadViewUnitsIndex
 */
export default function loadViewUnitsIndex() {
    $('#datatable-units-index').DataTable({
        language: {url: `${route().t.url}/dt-es-co.json`},
        stateSave: true,
        responsive: true,
        ajax: {
            url: route('residential-units.index'),
            method: 'POST',
            data: d => ({start: d.start, length: d.length, search: d.search.value})
        },
        processing: true,
        serverSide: true,
        ordering: false,
        columns: [
            {data: 'name'},
            {data: 'address'},
            {
                className: 'text-center',
                data: function (row) {
                    return `<span class="prc-status status-value-${row.status}">${+row.status ? 'Activo' : 'Inactivo'}</span>`
                }
            },
            {
                className: 'text-center',
                data: function (row) {
                    return `
                        <a href="${route('residential-units.update', row.id)}" class="text-blue-green font-bold mr-2 cursor-pointer">Editar</a>
                        <a href="${route('residential-units.destroy', row.id)}" class="text-red-500 font-bold cursor-pointer" data-confirm-delete="true">Eliminar</a>
                    `
                }
            }
        ]
    });
}
<x-app-layout>

    <x-header :title="__('Unidades Residenciales')">
        <x-button link href="{{route('residential-units.create')}}">
            <i class="bi bi-save"></i>
            Registrar Unidad
        </x-button>
    </x-header>

    <x-card>
        <table id="datatable-units-index" class="prc-datatable">
            <thead>
            <tr>
                <th>{{__('Nombre')}}</th>
                <th>{{__('Dirección')}}</th>
                <th>{{__('Estado')}}</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
        </table>
    </x-card>

</x-app-layout>
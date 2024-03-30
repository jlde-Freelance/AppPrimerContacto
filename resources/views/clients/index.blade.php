<x-import-library name="DataTable"/>
<x-app-layout>
    <x-header :title="__('Lista de Clientes')">
        <x-button link href="{{route('clients.create')}}">
            <i class="bi bi-save"></i>
            Registrar Cliente
        </x-button>
    </x-header>
    <x-card>
        <table id="datatable-clients-index" class="prc-datatable">
            <thead>
            <tr>
                <th>{{__('Nombre')}}</th>
                <th>{{__('Teléfono')}}</th>
                <th>{{__('Correo')}}</th>
                <th>{{__('Estado')}}</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
        </table>
    </x-card>
</x-app-layout>
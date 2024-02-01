<x-import-library name="DataTable"/>
<x-app-layout>
    <x-header :title="__('Buscador de Inmuebles')">
        <x-button link href="{{route('real-estate.create')}}">
            <i class="bi bi-save"></i>
            Crear Inmueble
        </x-button>
    </x-header>
    <x-card>
        <table id="datatable-real-estate-index" class="prc-datatable">
            <thead>
                <tr>
                    <th>{{__('Información del Inmueble')}}</th>
                    <th>{{__('Acción')}}</th>
                    <th>{{__('Información')}}</th>
                    <th>{{__('Estado')}}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </x-card>
</x-app-layout>
<x-import-library name="Currency"/>
<x-import-library name="DataTable"/>
<x-app-layout x-data="{ open: false }">
    <x-header :title="__('Buscador de Inmuebles')">
        <div class="flex flex-row gap-2">
            <x-button x-on:click="open = ! open">
                <i x-bind:class="{'bi bi-funnel': !open, 'bi bi-eye-slash': open}"></i>
                <span x-text="open ? 'Ocultar filtros' : 'Ver filtros'"></span>
            </x-button>
            <x-button link href="{{route('real-estate.create')}}">
                <i class="bi bi-save"></i>
                Crear Inmueble
            </x-button>
        </div>
    </x-header>
    <x-card class="my-4" x-show="open">
        @include('real-estate.form-filters', get_defined_vars())
    </x-card>
    <x-card>
        <x-tabs.container>
            <x-slot:links>
                <x-tabs.link id="real-estate-list"><i class="bi bi-list text-2xl"></i>{{__('Listado')}}</x-tabs.link>
                <x-tabs.link id="real-estate-map"><i class="bi bi-map text-2xl"></i>{{__('Mapa')}}</x-tabs.link>
            </x-slot>
            <x-slot:bodies>
                <x-tabs.body id="real-estate-list">
                    <table id="datatable-real-estate-index" class="prc-datatable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{__('Información del Inmueble')}}</th>
                            <th>{{__('Acción')}}</th>
                            <th>{{__('Información')}}</th>
                            <th>{{__('Estado')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                    </table>
                </x-tabs.body>
                <x-tabs.body id="real-estate-map">
                    <div class="md:col-span-3 py-2">
                        <div id="map" style="height: 400px; width: 100%; cursor: crosshair;"></div>
                    </div>
                </x-tabs.body>
            </x-slot>
        </x-tabs.container>
    </x-card>
</x-app-layout>

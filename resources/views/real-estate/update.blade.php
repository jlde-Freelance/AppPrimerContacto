<x-app-layout>

    <x-header :title="__('Actualizar inmueble')"/>

    <x-card>
        @include('real-estate.form', get_defined_vars())
    </x-card>

</x-app-layout>
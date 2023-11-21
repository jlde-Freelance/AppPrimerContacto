<x-app-layout>

    <x-header :title="__('Actualizar unidad residencial')"/>

    <x-card>
        @include('residential-units.form', compact('Options','model'))
    </x-card>

</x-app-layout>
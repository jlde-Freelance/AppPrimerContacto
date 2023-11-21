<x-app-layout>

    <x-header :title="__('Registrar unidad residencial')"/>

    <x-card>
        @include('residential-units.form', compact('Options'))
    </x-card>

</x-app-layout>
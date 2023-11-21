<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">

    <div class="h-full px-3 py-4 overflow-y-auto bg-blue-green">

        <div class="content-img flex justify-center mb-10">
            <x-logo-gold class="max-w-[70%]"/>
        </div>

        <div class="uppercase text-sm font-bold text-vegas-gold mb-2 mt-4">Mi menú</div>
        <ul class="space-y-2 font-medium">
            {{--            <x-sidebar-item icon="person-fill-gear" label="Información Personal"/>--}}
            <x-sidebar-item to="{{route('logout')}}" icon="door-open" label=" Cerrar Sesión"/>
        </ul>

        <div class="uppercase text-sm font-bold text-vegas-gold mb-2 mt-4">Aplicaciones</div>
        <ul class="space-y-2 font-medium">
            @if(Auth::user()->isAdmin())
                <x-sidebar-item to="{{route('dashboard')}}" icon="checks-grid" label="Panel de Control"/>
                <x-sidebar-item-dropdown icon="buildings" label="Admin. Unidades" path="residential-units">
                    <x-sidebar-item label="Listar Unidades" to="{{route('residential-units.index')}}"/>
                    <x-sidebar-item label="Crear Unidades" to="{{route('residential-units.create')}}"/>
                </x-sidebar-item-dropdown>
            @endif
{{--            <x-sidebar-item-dropdown icon="houses" label="Admin. Inmuebles" path="real-estate">--}}
{{--                <x-sidebar-item label="Buscar Inmuebles" to="{{route('real-estate.index')}}"/>--}}
{{--                <x-sidebar-item label="Crear Inmueble" to="{{route('real-estate.create')}}"/>--}}
{{--            </x-sidebar-item-dropdown>--}}
        </ul>

    </div>
</aside>
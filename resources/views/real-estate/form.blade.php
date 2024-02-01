<x-import-library name="Select2"/>
<x-import-library name="LeafLet"/>
<x-import-library name="InputMask"/>
<form method="POST" enctype='multipart/form-data' action="{{ isset($RealEstate) ? route('real-estate.update',$RealEstate) :'' }}">
    @csrf

    <x-tabs.container>
        <x-slot:links>
            <x-tabs.link id="info-base" class="text-3xl"><i class="bi bi-house-gear text-2xl"></i>{{__('Datos básicos')}}</x-tabs.link>
            <x-tabs.link id="info-admin"><i class="bi bi-geo-alt text-2xl"></i>{{__('Localización')}}</x-tabs.link>
            <x-tabs.link id="info-media"><i class="bi bi-images text-2xl"></i>{{__('Multimedia')}}</x-tabs.link>
        </x-slot>
        <x-slot:bodies>
            <x-tabs.body id="info-base">
                @include('real-estate.include.form-base', get_defined_vars())
            </x-tabs.body>
            <x-tabs.body id="info-admin">
                @include('real-estate.include.form-location', get_defined_vars())
            </x-tabs.body>
            <x-tabs.body id="info-media">
                media
            </x-tabs.body>
        </x-slot>

    </x-tabs.container>

    <hr>

    <div class="prc-input-group mt-3 flex flex-col md:flex-row gap-3 md:col-span-2">
        <x-button>
            <i class="bi bi-save"></i>
            @if(isset($model)) Actualizar @else Registrar @endif Inmueble
        </x-button>
        <x-button secondary link href="{{route('residential-units.index')}}">
            <i class="bi bi-arrow-left-short"></i>
            Regresar
        </x-button>
    </div>

</form>
<x-import-library name="Select2"/>
<x-import-library name="LeafLet"/>
<x-import-library name="InputMask"/>
<x-import-library name="Lodash"/>

<form enctype='multipart/form-data' id="filter-datatable-real-estate-index">
    @csrf

    <x-tabs.container>
        <x-slot:links>
            <x-tabs.link id="form-basic-filters"><i class="bi bi-search text-2xl"></i>{{__('Filtros básicos')}}</x-tabs.link>
            <x-tabs.link id="form-advanced-filters"><i class="bi bi-eyedropper text-2xl"></i>{{__('Filtros avanzados')}}</x-tabs.link>
        </x-slot>
        <x-slot:bodies>
            <x-tabs.body id="form-basic-filters">
                @include('real-estate.include.form-basic-filters', get_defined_vars())
            </x-tabs.body>
            <x-tabs.body id="form-advanced-filters">
                @include('real-estate.include.form-advanced-filters', get_defined_vars())
            </x-tabs.body>
        </x-slot>
    </x-tabs.container>

    <div class="prc-input-group mt-3 flex flex-col md:flex-row gap-3 md:col-span-2">
        <x-button secondary type="reset">
            <i class="bi bi-trash"></i>
            Limpiar
        </x-button>
        <x-button type="submit">
            <i class="bi bi-search"></i>
            Buscar
        </x-button>
    </div>

</form>


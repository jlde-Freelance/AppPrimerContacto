@switch($name)
    @case("DataTable")
        @push('stylesheet')
            <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
        @endpush
        @push('scripts')
            <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            {{--        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>--}}
        @endpush
        @break
    @case("Select2")
        @push('stylesheet')
            <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
        @endpush
        @push('scripts')
            <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @endpush
        @break
    @case("LeafLet")
        @push('stylesheet')
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css"
            />
        @endpush
        @push('scripts')
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
        @endpush
        @break
    @case("PhotoSwipe")
        @push('stylesheet')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css"/>
        @endpush
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
        @endpush
        @break
    @case("InputMask")
        @push('scripts')
            <script src="//cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/jquery.inputmask.min.js"></script>
        @endpush
        @break
    @case("Lodash")
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
        @endpush
        @break
    @case("Currency")
        @push('scripts')
            <script src="//unpkg.com/currency.js@2.0.4/dist/currency.min.js"></script>
        @endpush
        @break
@endswitch

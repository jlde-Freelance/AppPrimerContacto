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
        @endpush
        @push('scripts')
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        @endpush
        @break
    @case("InputMask")
        @push('scripts')
            <script src="//cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/jquery.inputmask.min.js"></script>
        @endpush
        @break
    @case("Currency")
        @push('scripts')
            <script src="//unpkg.com/currency.js@2.0.4/dist/currency.min.js"></script>
        @endpush
        @break
@endswitch

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet"/>

    <!-- Scripts -->
    @stack('stylesheet')
    @vite('resources/css/app.css')
    @routes
</head>
<body {{ $attributes->merge(['class'=> 'bg-bright-gray']) }}>

    {{ $slot }}

    <x-loading/>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>

    @stack('scripts')
    @vite('resources/js/app.js')
</body>
</html>

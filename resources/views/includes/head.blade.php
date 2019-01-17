<head>
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charSet="utf-8" />
    <title>{{ config('Printeerz', 'Printeerz') }}</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset ('fonts/feather/feather.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/highlight.js/styles/vs2015.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/quill/dist/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/flatpickr/dist/flatpickr.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
        
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}" id="stylesheetLight">
    {{-- <link rel="stylesheet" href="{{ asset('css/theme-dark.min.css') }}" id="stylesheetDark"> --}}

    <style>body { display: none; }</style>

    <script>
        var colorScheme = ( localStorage.getItem('dashkitColorScheme') ) ? localStorage.getItem('dashkitColorScheme') : 'light';
    </script>

    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}" />

</head>
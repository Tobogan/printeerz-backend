<!DOCTYPE html>

<head>
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charSet="utf-8" />
    <title>{{ config('Printeerz', 'Printeerz') }} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    {{-- <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /> --}}
    {{-- Libs CSS --}}
    <link rel="stylesheet" href="{{ asset ('fonts/feather/feather.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/highlight.js/styles/vs2015.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/quill/dist/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    {{-- Theme CSS --}}
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}" id="stylesheetLight">
    {{-- To remove later --}}
    <style>
        nav.navbar-dark {
            background: #3f4C9b;
            /* background: -webkit-linear-gradient(to left, #fcb045, #fd1d1d, #833ab4);
            background: linear-gradient(to left, #fcb045, #fd1d1d, #833ab4); */
        }

        .event_product_colors {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .event_product_color {
            width: 24px;
            height: 24px;
        }

        .tox-tinymce {
            border: 1px solid #d2ddec !important;
            border-radius: .5rem !important;
        }

        .tox-statusbar {
            border-color: #d2ddec !important;
            display: none;
        }

        .tox-statusbar__branding {
            display: none;
        }

        .tox-edit-area {
            border-top: 1px solid #d2ddec !important;
        }

        .tox-toolbar__group:not(:last-of-type) {
            border-right: 1px solid #d2ddec !important;
        }

        .custom-file-label:after {
            content: "Parcourir";
        }

        .alerts .alert {
            border: 0;
            margin: 0;
            text-align: center;
        }

        /* progress bar event */
        .progressbar {
            counter-reset: step;
            width: 100%;
        }

        .progressbar li {
            list-style-type: none;
            width: 16%;
            float: left;
            font-size: 10px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #D3D3D3;
        }

        .progressbar li:before {
            width: 35px;
            height: 35px;
            content: counter(step);
            counter-increment: step;
            line-height: 35px;
            border: 2.5px solid #D3D3D3;
            display: block;
            text-align: center;
            margin: 0 auto 5px auto;
            border-radius: 50%;
            background-color: white;
        }

        .progressbar li:after {
            width: 100%;
            height: 2.5px;
            content: '';
            position: absolute;
            background-color: #D3D3D3;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbar li:first-child:after {
            content: none;
        }

        .progressbar li.active {
            color: green;
        }

        .progressbar li.active:before {
            border-color: #55b776;
            background-color: #55b776;
            color: white;
        }

        .progressbar li.active+li:after {
            background-color: #55b776;
        }

        /* .progressbarClickable.after {
            width: 100%;
            height: 2.5px;
            content: '';
            position: absolute;
            background-color: blue;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbarClickable. {
            width: 35px;
            height: 35px;
            line-height: 35px;
            border: 2.5px solid blue;
            display: block;
            text-align: center;
            margin: 0 auto 5px auto;
            border-radius: 50%;
            background-color: white;
        } */

        /* font color custom */
        .colorSquare {
            width: 15px;
            height: 15px;
            float: left;
            border-radius: 2px;
            border: solid;
            border-width: 0.5px;
            border-color: grey;
        }
    </style>
</head>
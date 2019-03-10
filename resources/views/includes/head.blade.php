<!DOCTYPE html>
<head>
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charSet="utf-8" />
    <title>{{ config('Printeerz', 'Printeerz') }}</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    {{-- Libs CSS --}}
    <link rel="stylesheet" href="{{ asset ('fonts/feather/feather.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/highlight.js/styles/vs2015.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/quill/dist/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('libs/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    {{-- Theme CSS --}}
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}" id="stylesheetLight">
    {{-- To remove later --}}
    <style>
        nav.navbar-dark {
            background: #833ab4;
            background: -webkit-linear-gradient(to left, #fcb045, #fd1d1d, #833ab4);
            background: linear-gradient(to left, #fcb045, #fd1d1d, #833ab4);
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
        .tox-tinymce{
            border: 1px solid #d2ddec !important;
            border-radius: .5rem !important;
        }
        .tox-statusbar{
            border-color: #d2ddec !important;
            display: none;
        }
        .tox-statusbar__branding{
            display: none; 
        }
        .tox-edit-area{
            border-top: 1px solid #d2ddec !important;
        }
        .tox-toolbar__group:not(:last-of-type) {
            border-right: 1px solid #d2ddec !important;
        }
        .custom-file-label:after {
            content: "Parcourir";
        }
    </style>
</head>
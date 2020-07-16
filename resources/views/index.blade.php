<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('app.main.title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"
        rel="stylesheet"
    />

    <style>
        #menu-toggle:checked + #menu {
            display: block;
        }
    </style>

</head>
<body class="antialiased">
    <div id="app"></div>
</body>
<script src="{!! url('js/app.js') !!}"></script>
</html>

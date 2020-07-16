<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('app.main.title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="height: 100vh">
<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-6 mx-auto text-center">
            <img src="{{ env('APP_LOGO') }}" style="width: 25rem;" />
            <h1 class="text-2xl font-bold mt-5 mb-5">@lang('app.checkin.title')</h1>
            <p class="lead">@lang('app.checkin.text_1')</p>
            <p class="lead">@lang('app.checkin.text_2')</p>
            <form action="do_checkin" method="post">
                <input class="border border-dark rounded w-full py-2 px-3  text-black" type="text" name="barcode" id="barcode" autofocus required>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    document.getElementById('barcode').focus();
</script>
</html>

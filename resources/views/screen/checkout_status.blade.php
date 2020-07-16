<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('app.main.title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="height: 100vh">
<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-6 mx-auto text-center">
            <img src="{{ env('APP_LOGO') }}" style="width: 25rem;" />

            @if($check_out)
                <h1 class="text-2xl font-bold mt-5 mb-5">@lang('app.checkout.status.checkout_success.title')</h1>
                <p class="lead font-weight-bold">@lang('app.checkout.status.checkout_success.text')</p>
            @else
                <h1 class="text-2xl font-bold mt-5 mb-5">@lang('app.checkout.status.checkout_failure.title')</h1>
                <p class="lead font-weight-bold">@lang('app.checkout.status.checkout_failure.text')</p>
            @endif
        </div>
    </div>
</div>
</body>
<script>
    setTimeout(function(){
        window.location.href = 'checkout';
    }, 5000);
</script>
</html>

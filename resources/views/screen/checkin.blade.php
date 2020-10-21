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
            <img src="{{ $location->logo_uri }}" style="width: 25rem;" />
            <h3 class="text-xl font-bold mt-5 mb-0">{{ $location->name }}</h3>
            <h1 class="text-2xl font-bold mt-3 mb-3">@lang('app.checkin.title')</h1>
            <p class="lead">@lang('app.checkin.text_1')</p>
            @if ($location->is_pre_check_in_displayed && $location->allowed_minutes_for_pre_check_in > 0)
                <p class="lead">@lang('app.checkin.pre_check_in', ['allowed_minutes_for_pre_check_in' => $location->allowed_minutes_for_pre_check_in])</p>
            @endif
            <p class="lead">@lang('app.checkin.text_2')</p>
            <form action="{{ route('post_checkin') }}" method="post">
                <input type="hidden" name="location" id="location" value="{{ $location->id }}">
                <input class="border border-dark rounded w-full py-2 px-3  text-black" type="text" name="barcode" id="barcode" autofocus required>
            </form>
            <div id="clock" class="small"></div>
        </div>
    </div>
</div>
</body>
<script>
    document.getElementById('barcode').focus();

    let render = function (template, node) {
        if (!node) return;
        node.innerHTML = (typeof template === 'function' ? template() : template);
        var event = new CustomEvent('elementRenders', {
            bubbles: true
        });
        node.dispatchEvent(event);
        return node;
    };

    render(new Date().toLocaleTimeString(), document.querySelector('#clock'));

    window.setInterval(function () {
        render(new Date().toLocaleTimeString(), document.querySelector('#clock'));
    }, 1000);
</script>
</html>

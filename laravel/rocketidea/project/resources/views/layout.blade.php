<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rocket Idea')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body style="min-height: 100%;padding-bottom:321px;position:relative;" class="">

    @include('partials/header')

    <div id="app" style="margin-bottom:50px;"class="container">
        <div style="width:100%;">
            @yield('content')
        </div>
    </div>
    @include('partials/scripts')
    @include('partials/footer')
</body>
</html>
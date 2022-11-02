<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title></title>
    <meta name="description" content="">
    @if(str_contains(url()->current(),'writers-for-enterprises') || str_contains(url()->current(),'custom-ghostwriting-service') || str_contains(url()->current(),'best-ghostwriters') )
    <meta property="ROBOTS" content="NOINDEX, NOFOLLOW">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('app/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('app/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('app/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('app/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff"> --}}
    <link href="{{ mix('css/app.min.css') }}" type="text/css" rel="stylesheet" />
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div id="app"></div>
    <script src="{{ mix('js/main.min.js') }}" type="text/javascript"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>

</html>

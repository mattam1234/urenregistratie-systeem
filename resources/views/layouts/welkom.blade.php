<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body class="body">
<div class="blue-block1"></div>
<div class="blue-block2"></div>
<div class="blue-block3"></div>
<div></div>
<div class="container w-container"><img
        src="{{asset('images/logo-tsd.png')}}" width="163"
        alt="" class="image"/>
    <main class="w.container">
        @yield('content')
    </main>
</div>
</body>
</html>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- icon -->
    <link rel="icon" href="{{ asset('favicon.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/js.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7c1e9989e2.js" crossorigin="anonymous" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="d-flex flex-column h-screen justify-content-between">
        @include('layouts.nav')
        <main class="py-4">
            @include('layouts.session-status')
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
</body>

</html>

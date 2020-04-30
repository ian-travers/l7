<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="bg-image">
<div id="app" class="full-overlay darkest-overlay">
    @include('layouts._topnav')

    <flash content="{{ session('flash') }}"></flash>

    <main class="py-4">
        {{ $slot }}
    </main>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>

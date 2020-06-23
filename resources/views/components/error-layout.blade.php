<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="bg-error-404">
<div id="app" class="full-overlay d-flex flex-column h-100">
    <header>

        @include('layouts._topnav')
    </header>
    <main class="py-4">
        {{ $slot }}
    </main>
    <footer class="mt-auto">

        @include('layouts._footer')
    </footer>
</div>

<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>

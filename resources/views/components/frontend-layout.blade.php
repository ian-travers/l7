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
<div id="app" class="full-overlay d-flex flex-column h-100">
    <header>

        @include('layouts._topnav')
    </header>

    @yield('info')
    <flash content="{{ session('flash') }}"></flash>

    <main class="py-4">
        {{ $slot }}
    </main>

    <footer class="mt-auto">

        @include('layouts._footer')
    </footer>
</div>

<!-- Scripts -->
<script>
    window.App = {!! json_encode([
        'user' => auth()->user(),
        'signedIn' => auth()->check()
    ]) !!}
</script>

<script src="{{ mix('js/app.js', 'build') }}"></script>

@yield('script')
</body>
</html>

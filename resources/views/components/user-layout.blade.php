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
<body>
<div id="app">
    @include('layouts._topnav')

    <flash content="{{ session('flash') }}"></flash>
    <main class="py-2">
        <div class="container-fluid">

            @section('breadcrumbs', Breadcrumbs::render())
            @yield('breadcrumbs')
            <div class="row">
                <div class="col-2">
                    <x-user-left-menu/>
                </div>
                <div class="col-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'build') }}"></script>

@yield('script')
</body>
</html>

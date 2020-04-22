<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="bg-image">
<div id="app" class="full-overlay dark-overlay">
    <div class="d-flex py-4">
        <div class="container constrain">
            <div class="row justify-content-center">
                <a href="{{ url("/") }}">
                    <img src="/images/logo_70x70.png" alt="logo" class="rounded-circle border border-primary border-2">
                </a>
            </div>

            {{ $slot }}

        </div>
    </div>
</div>
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>

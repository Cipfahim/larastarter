<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('settings.app_name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('layouts.backend.partials.header')
    @include('layouts.backend.partials.settings')
    <div class="app-main">
        @include('layouts.backend.partials.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner">
                @yield('content')
            </div>
            @include('layouts.backend.partials.footer')
        </div>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/backend.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.png">
    <title>{{ config('app.name', 'ADMINPANEL') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')

</head>
<body>
<div class="wrapper">
    @include('partials.admin.sidebar')
    <div id="content-wrapper">
        @include('partials.admin.header')
        @include('partials.admin.progress')
        <div id="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @yield('flex-content')
        @include('partials.admin.quickview')
    </div>
</div>

<!-- Scripts -->
<script src="{{asset("js/admin.js")}}"></script>
@stack('scripts')

</body>
</html>

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
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<div id="app">
    @include('partials.search.header')
    <filter-component :is-csv={{ Auth::user()->csv }}></filter-component>
</div>

<!-- Scripts -->

<script src="{{asset("js/search.js")}}"></script>
@stack('scripts')
</body>
</html>

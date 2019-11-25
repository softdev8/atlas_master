<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'A T L A S') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a href="{{ url('/search') }}">Search page</a>

                    @can('AccessToAdminpanel')                      
                        <a href="{{ url('/admin') }}">Admin-Panel</a>
                    @endcan

                    <a href="#" role="button" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    {{-- <a href="/admin">Admin-Panel</a>--}}
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endauth
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>

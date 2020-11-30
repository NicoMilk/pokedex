<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"-->
    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>

<div class="container-fluid p-0 h-100">
    <div class="d-flex flex-column  justify-content-between h-100">
    <h3 class="text-center py-3 m-0 bg-blur"><a href="{{ url('/') }}">Pokemon</a></h3>
    
    <div class="sep">&nbsp;</div>
    @auth
    <h5 class="p-3 bg-blur m-0">{{ __('Hello') }} {{ Auth::user()->name }}</h5>
    @endauth

    <main class="py-4 bg-blur h-100 overflow-auto">
        @yield('content')
    </main>
    

    <div class="sep">&nbsp;</div>
    <div class="nav-bottom p-4 bg-blur">
    @guest
        <a class="m-4" href="{{ route('login') }}"><i class="fa fa-sign-in"></i></a>
        @if (Route::has('register'))
        <a class="m-4" href="{{ route('register') }}"><i class="fa fa-key"></i></a>
        @endif
    @else            
        <a class="m-4" href="{{ route('profile.edit', auth()->id()) }}"><i class="fa fa-user"></i></a>
        <a class="m-4" href="{{ route('password.request') }}"><i class="fa fa-key"></i></a>

        <a class="m-4" href="{{ route('logout') }}" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
    </div>
</body>
</html>

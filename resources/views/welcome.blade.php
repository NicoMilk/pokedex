<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pokedex</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">


</head>
<body">
    <div class="container-fluid p-0 h-100">
        <div class="d-flex flex-column  justify-content-between h-100">
            <h3 class="text-center py-3 m-0 bg-blur">
                <a href="{{ url('/') }}">Pokemon</a>
            </h3>
            <div class="sep">&nbsp;</div>
            <div class="content bg-blur h-100 overflow-auto" id="app">
                Welcome page to Pokedex App
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
            <div class="sep">&nbsp;</div>
            <div class="nav-bottom p-4 bg-blur">
            @if (Route::has('login'))
                <div class="">
                @auth
                    <a class="m-3" href="{{ url('/home') }}"><i class="fa fa-home"></i></a>
                @else
                    <a class="m-3" href="{{ route('login') }}"><i class="fa fa-sign-in"></i></a>

                    @if (Route::has('register'))
                        <a class="m-3" href="{{ route('register') }}"><i class="fa fa-key"></i></a>
                    @endif
                @endauth
                </div>
            @endif
            </div>
        </div>
    </div>
    </body>
</html>

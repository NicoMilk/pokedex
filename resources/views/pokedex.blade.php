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
    <div class="container-fluid p-0 h-100" id="app">
        <div class="d-flex flex-column  justify-content-between h-100">
            <h3 class="text-center py-3 m-0 bg-blur">
                <a href="{{ url('/') }}">Pokemon</a>
            </h3>
            <div class="sep">&nbsp;</div>
            
            <div class="content bg-blur h-100 overflow-auto" >

                <router-view></router-view>
                
            </div>

            <div class="sep">&nbsp;</div>
            <div class="tab p-4 bg-blur">

                <router-link to="/"><img src="/img/pokemon-tab.png" alt="Pokedex"/><span>Pokemon</span></router-link>
                <router-link to="/team"><img src="/img/team-tab.png" alt="Team"/><span>Team</span></router-link>
                <router-link to="/trade"><img src="/img/trade-tab.png" alt="Trade"/><span class="offset">Trade</span></router-link>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

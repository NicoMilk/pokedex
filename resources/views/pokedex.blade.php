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
<body>
    <div class="container-fluid p-0 h-100" id="app">
                
                <router-view></router-view>                
            
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'apiToken' => Auth::user()->api_token ?? null
    ]) !!};
    </script>
</body>
</html>

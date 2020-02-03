<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Vue SPA</title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}

</head>
<body>
    <br>
    <div id="app">

        <div class="navbar-header"style="margin-left: 10px">
            <router-link to="/" class="navbar-brand">Vue SPA</router-link>
        </div>
        <div style="margin-left: 25px">
            <ul class="nav navbar-nav navbar-right">
                <router-link to="/about" tag="li">
                    <a>About</a>
                </router-link>
            </ul>
        </div>


        <router-view></router-view>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="container">
        <div class="content">
            <h1 class="m-b-md display-1">
                {{env('APP_NAME', 'Legion Command')}}
            </h1>
            <p class="lead">
                Star Wars Legion is a miniature war-game set in the Star Wars universe, created by Fantasy Flight Games.
                Legion Command allows you to keep an inventory of your units, build armies, track wins and losses and so
                much more. Get started now for free!
            </p>
        </div>
        @if (Route::has('login'))
            <div class="d-flex justify-content-center">
                @auth
                    <a href="{{ url('/home') }}"><button class="btn btn-lg btn-outline-info">{{ __("Dashboard") }}</button></a>
                @else
                    <a href="{{ route('login') }}"><button class="btn btn-lg btn-outline-info mr-2">Log in</button></a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"><button class="btn btn-lg btn-outline-info">Register</button></a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
</body>
</html>

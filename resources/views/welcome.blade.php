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
        .content {
            text-align: center;
        }
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="">
    <div class="container my-5">
        <div class="content">
            <h1 class="display-4">
                {{env('APP_NAME', 'Legion Command')}}
            </h1>
            <p class="lead">
                Star Wars Legion is a miniature war-game set in the Star Wars universe, created by Fantasy Flight Games.
                Legion Command allows you to keep an inventory of your units, build armies, track wins and losses and so
                much more. <span class="font-weight-bold">Get started now for free!</span>
            </p>
        </div>
        @if (Route::has('login'))
            <div class="d-flex justify-content-center">
                @auth
                    <a href="{{ url('/home') }}">
                        <button class="btn btn-lg btn-outline-info">{{ __("Dashboard") }}</button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button class="btn btn-lg btn-outline-info mr-2">Log in</button>
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <button class="btn btn-lg btn-outline-info">Register</button>
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
<div class="container text-center">
    <h4>Why use Legion Command?</h4>
    <p class="lead">
        There are a collection of brilliant army building websites and applications available.
        We encourage you to use the one that you're most comfortable with. However, here are some reasons for
        using/switching to Legion Command.
    </p>
</div>
<div class="container my-5">
    <h5>1) Powerful features, simple implementation</h5>
    <p>
        Whilst Legion Command is a hobby project for us, we take its development seriously.
        We create powerful applications for a living, and we've brought our knowledge over
        to Legion Command to create a beautiful, smooth and secure platform.
    </p>
    <h5>2) Available on every device</h5>
    <p>
        Legion Command is available on any web browser. That means that you can access it
        from your desktop, tablet, phone, smart tv, raspberry pi... you get the picture.
        Further, we've built Legion Command to look great on every device. It will adapt to make the
        best use of the space available to it, from the smallest phone to your 4k gaming monitor. And because
        your armies are store securely in the cloud (see point 4), you can switch seamlessly from one device to another.
    </p>
    <h5>3) Free for everybody</h5>
    <p>
        Legion Command might be powerful, but we also want it to be accessible. To help reach as many players
        as possible, Legion Command is free to use. You can build as many lists as you'd like with no worries about
        hidden costs. But, you may ask, 'how can you provide a service for free?'
    </p>
    <h5>4) We certainly don't sell your data, nor do we run invasive ads</h5>
    <p>
        Your privacy is important to us. Legion Command is built on the rock solid Laravel Framework and as such,
        it has security to boot. We don't run any ads, send your data to 3rd parties (even anonymously) or share
        information from this site with anybody you haven't approved. We've even refrained from using social providers
        for sign in such as Google and Facebook to keep separate from data harvesting companies. You're welcome!
    </p>
    <h5>5) We're community run</h5>
    <p>
        So how are we funded? Primarily by your generous donations. If you enjoy using Legion Command, please consider
        donating to help us with the running costs of the site. We also plan on releasing a 'tournament' feature in the
        near
        future that will allow
        you to team up with a group of friends (or enemies) and track your progress across a number of games, with the
        ability
        to add images and more to remember every moment. This feature will be available for a <i>VERY</i> low cost in
        order to support
        the added cost of storing lots of images on a server.
    </p>
    <h5>6) We're open to suggestions</h5>
    <p>
        Being run by the community, we'd love to hear your suggestions. We want to improve and expand Legion Command to
        be the #1
        place for managing your Star Wars Legion lists. If you have an idea that you'd like to see implemented into
        Legion Command,
        just let us know!
    </p>
</div>
</body>
</html>

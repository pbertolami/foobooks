<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Opera</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/stylesheet1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <style>
        .flash_message {
            width: 100%;
            text-align: center;
            padding: 500px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: yellow;
            font-weight: bold;


        }

    </style>

</head>
<body style="padding-top: 70px">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project Opera</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        @if(Auth::check())
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="/auth/logout">Log Out</a></li>
                        @else
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="/auth/login">Log In</a></li>
                            <li><a href="/auth/register">Register</a></li>
                        @endif
                    </ul>
                </div>
                @if (Auth::check())
                       <p class="navbar-text navbar-right">
                           Hello, {{Auth::user()->name}}
                       </p>

                @endif

                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            @yield('content')

            @if(\Session::has('flash_message'))
                <p class="flash_message">
                    {{\Session::get('flash_message')}}
                </p>
            @endif

        </div>

        @yield('scripts.footer')






</body>
</html>
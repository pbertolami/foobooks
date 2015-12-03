<!doctype html>
<html>
<head>
        <title>
            {{--Yield the title if it exists, otherwise default to 'Foobooks' --}}
            @yield('title', 'Foobooks')
        </title>
        <meta charset="'utf-8">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/stylesheet1.css">
        {{--Yield any page specific CSS files or anything else you might want in the <head>--}}
        @yield('head')

</head>
<body>
@if(\Session::has('flash_message'))
<div class="flash_message">
    {{\Session::get('flash_message')}}
</div>
@endif

    <header>
        <img
                src='http://making-the-internet.s3.amazonaws.com/laravel-foobooks-logo@2x.png'
                style="width:300px"
                alt="Foobooks Logo">
    </header>
    <nav>
        <ul>
            @if(Auth::check())
                <li><a href='/'>Home</a></li>
                <li><a href='/books/create'>Add a book</a></li>
                <li><a href='/auth/logout'>Log out</a></li>
            @else
                <li><a href='/'>Home</a></li>
                <li><a href='/auth/login'>Log in</a></li>
                <li><a href='/auth/register'>Register</a></li>
            @endif
        </ul>
    </nav>
<section>
    {{--Main page content will be yielded here--}}
    @yield('content')
</section>
<footer>
    &copy; {{ date('Y') }}
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@yield('body')
</body>
</html>
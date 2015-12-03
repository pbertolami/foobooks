@extends('layout')



@section('content')

<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="remember" required> Remember Me</input>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default">Login</button>
            </div>

        </form>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                </ul>
            </div>
         @endif
    </div>
</div>
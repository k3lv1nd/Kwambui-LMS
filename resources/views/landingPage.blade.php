<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Loan Mangement system</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="ontop">
@include('partials.navbar')

</div>
<div class="welcome">
    <h1>Welcome To the Loan Management System</h1>
    <br>
    <br>
    @auth
        <a href="{{route('home')}}"  class="loggedin">You Already Signed In, Click to Go home</a>
    @else
    <a href="{{route('login')}}" class="button">Sign in</a>
    @endauth

</div>


</body>
</html>

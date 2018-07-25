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
    <ul class="navigation menu menu-centered expanded">
        <li class="menu-text show-for-medium">Loan Mamagement System</li>

        <li><a href="#">Pictures</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

</div>
<div class="welcome">
    <h1>Welcome To the Loan Mamagement System</h1>

    <a href="{{route('login')}}" class="button">Sign in</a>


</div>


</body>
</html>

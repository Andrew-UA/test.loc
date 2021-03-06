<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="container col-12">
            @include('layouts._navigation')
        </div>
        <div class="container col-12">
            @yield('content')
    </div>
</div>

</body>
<script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</html>

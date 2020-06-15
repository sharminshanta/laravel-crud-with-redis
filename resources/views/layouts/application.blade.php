<!DOCTYPE html>
<html lang="en">
<head>
    <title>TMSS | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="text-center">
        <img class="card-img-top" style="width: 100px" src="{{asset('assets/img/tmss.png')}}" alt="Card image cap">
    </div>
    <br>
    @yield('content')
</div>
</body>
</html>

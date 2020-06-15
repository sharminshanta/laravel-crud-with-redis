<!DOCTYPE html>
<html lang="en">
<head>
    <title>TMSS | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('/')}}assets/js/jquery.min.js"></script>
    <script src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
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

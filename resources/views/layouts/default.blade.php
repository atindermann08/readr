<!DOCTYPE html>
<html>
<head>
  <title>Laravel</title>

  <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <link href="{{ URL::asset('css/app.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('vendor/css/font-awesome.min.css')}}" rel="stylesheet">

</head>
<body>
  <div class="container">
    @section('nav')
      @include('layouts.partials._nav')
    @show
    @yield('content')
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>

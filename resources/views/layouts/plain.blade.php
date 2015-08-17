<!DOCTYPE html>
<html>
<head>
  <title>Livrogo</title>

  <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  {!! Html::style('assets/css/app.css') !!}
  {!! Html::style('assets/vendor/css/font-awesome.min.css') !!}
  {!! Html::style('assets/vendor/css/select2.min.css') !!}

</head>
<body>


      @include('flash::message')
      @include('layouts.partials._errors')
      @yield('content')

  @include('layouts.partials._footer')
  {!! Html::script('assets/vendor/js/jquery.min.js') !!}
  {!! Html::script('assets/vendor/js/bootstrap.min.js') !!}
  {!! Html::script('assets/vendor/js/select2.min.js') !!}
  {!! Html::script('assets/js/app.js') !!}
  @include('partials._google_analytics')
</body>
</html>
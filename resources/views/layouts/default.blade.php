<!DOCTYPE html>
<html>
<head>
  <title>Livrogo</title>

  <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  {!! Html::style('css/app.css') !!}
  {!! Html::style('vendor/css/font-awesome.min.css') !!}

</head>
<body>
  <div class="container">
    @section('nav')
      @include('layouts.partials._nav')
    @show
    <div class="row">
      <div class="col-md-12">
      {{-- @include('flash::message') --}}
      @yield('content')
      </div>
    </div>
  </div>
  @include('layouts.partials._footer')
  {!! Html::script('vendor/js/jquery.min.js') !!}
  {!! Html::script('vendor/js/bootstrap.min.js') !!}
  {!! Html::script('js/app.js') !!}
</body>
</html>

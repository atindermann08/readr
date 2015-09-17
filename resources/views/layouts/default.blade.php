<!DOCTYPE html>
<html>
<head>
  <title>Livrogo</title>

  {!! Html::style('assets/css/app.css') !!}
  {!! Html::style('assets/vendor/css/font-awesome.min.css') !!}
  {!! Html::style('assets/vendor/css/select2.min.css') !!}

</head>
<body>
    @section('nav')
      @include('layouts.partials._nav')
    @show

    @include('flash::message')
    @include('layouts.partials._errors')
    <div class="container content">
      <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
      </div>
    </div>

  @include('layouts.partials._footer')
  {!! Html::script('assets/vendor/js/jquery.min.js') !!}
  {!! Html::script('assets/vendor/js/bootstrap.min.js') !!}
  {!! Html::script('assets/vendor/js/select2.min.js') !!}
  {!! Html::script('assets/js/app.js') !!}
  <!-- @include('partials._google_analytics') -->
</body>
</html>

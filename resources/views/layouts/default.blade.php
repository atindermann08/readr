<!DOCTYPE html>
<html>
<head>
  <title>Livrogo</title>

  @include('layouts.partials._styles')

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
  @include('layouts.partials._scripts')
</body>
</html>

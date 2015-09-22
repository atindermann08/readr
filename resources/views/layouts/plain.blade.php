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
    @yield('cover')

  @include('layouts.partials._footer')
  @include('layouts.partials._scripts')
</body>
</html>

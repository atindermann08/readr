<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Readr</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="#"><i class="fa fa-leanpub fa-fw"></i>My Library<span class="sr-only">(current)</span></a></li>
        <li><a href="#"><i class="fa fa-book fa-fw"></i>Books</a></li>
        <li><a href="#"><i class="fa fa-th-large fa-fw"></i>Browse</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control search-bar" id="top-search-bar" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default search-bar-btn">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out fa-fw"></i>Sign Out</a></li>
        @else
          <li class="{{ Active::pattern('auth/login')}}"><a href="{{url('auth/login')}}"><i class="fa fa-sign-out fa-fw"></i>Sign In</a></li>
          <li class="{{ Active::pattern('auth/register')}}"><a href="{{url('auth/register')}}"><i class="fa fa-user fa-fw"></i>Register</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

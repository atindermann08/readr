<nav class="navbar navbar-inverse navbar-fixed-top">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Livrogo</a>
    </div>

  <div class="container">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       <li class="{{ Active::pattern('mylibrary')}}"><a href="{{route('mylibrary')}}"><i class=' fa fa-book fa-fw'></i>My Library</a></li>
       <li class="dropdown {{ Active::pattern('bookclubs*')}}">
         <a href="{{route('bookclubs.index')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
           <i class=' fa fa-group fa-fw'></i>Book Clubs
           <span class="caret"></span>
        </a>
         <ul class="dropdown-menu">
           <li><a href="{{route('bookclubs.create')}} ">Create New Book Club</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="{{route('bookclubs.index')}}">List</a></li>
         </ul>
       </li>
       <li class="{{ Active::pattern('discussions')}}"><a href="{{route('discussions.index')}}">
         <i class='fa fa-comments fa-fw'></i>Discussions</a></li>
      </ul>
      {{--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control search-bar" id="top-search-bar" placeholder="Coming Soon">
        </div>
        <button type="submit" class="btn btn-default search-bar-btn">Search</button>
      </form>
      --}}
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li class="dropdown @unless($notifications->count() == 0)  active @endunless">
            <a href="" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class='fa fa-bell fa-fw'></i>
              <span class="notifications-count">@unless($notifications->count() == 0) {{ $notifications->count() }} @endunless</span>
            </a>
            <ul class="dropdown-menu">
              @if(count($notifications))
                <li class='dropdown-header'>Notifications</li>
                @foreach($notifications as $notification)
                  <li><a href="{{ $notification->url }}">{{ $notification->text }} </a></li>
                @endforeach
              @else
                <li><a>No Unread Notifications<span></a></li>
              @endif
            </ul>
          </li>
          <li class="dropdown">
            <a href='' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset(auth()->user()->profile->thumb_image) }}" alt="{{ auth()->user()->name }}"
              class='profile-thumb-image '></img>
              &nbsp; Welcome, {{ucfirst(\Auth::user()->name)}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{url('profile')}}"><i class="fa fa-user fa-fw"></i>Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{url('password/change')}}"><i class="fa fa-lock fa-fw"></i>Change Password</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out fa-fw"></i>Sign Out</a></li>
            </ul>
          </li>

        @else
          <li class="{{ Active::pattern('auth/login')}}"><a href="{{url('auth/login')}}"><i class="fa fa-sign-out fa-fw"></i>Sign In</a></li>
          <li class="{{ Active::pattern('auth/register')}}"><a href="{{url('auth/register')}}"><i class="fa fa-user fa-fw"></i>Register</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>

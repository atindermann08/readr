

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
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

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
         <a href="{{route('books.index')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
           <i class=' fa fa-book fa-fw'></i>Books
           <span class="caret"></span>
        </a>
         <ul class="dropdown-menu">
          {{--
           <li><a href="{{route('books.create')}} ">Add Book</a></li>
           <li role="separator" class="divider"></li>
           <li><a href="{{route('books.index')}}">List</a></li>
           --}}
           <li><a href="{{route('mylibrary')}}">My Library</a></li>
         </ul>
       </li>
       <li class="dropdown">
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
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class=' fa fa-bell fa-fw'></i>
            </a>
            <ul class="dropdown-menu">
              @if(count($notifications))
                <li class='dropdown-header'>Notifications</li>
                @foreach($notifications as $notification)
                  <li><a href="{{ route('notifications') }}">{{ $notification['count'] }} {{ $notification['type'] }}</a></li>
                @endforeach
              @else
                <li><a>No Unread Notifications<span></a>
              @endif
            </ul>
          </li>
          <li><a>Welcome, {{ucfirst(\Auth::user()->name)}}</a></li>
          <li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out fa-fw"></i>Sign Out</a></li>
        @else
          <li class="{{ Active::pattern('auth/login')}}"><a href="{{url('auth/login')}}"><i class="fa fa-sign-out fa-fw"></i>Sign In</a></li>
          <li class="{{ Active::pattern('auth/register')}}"><a href="{{url('auth/register')}}"><i class="fa fa-user fa-fw"></i>Register</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>

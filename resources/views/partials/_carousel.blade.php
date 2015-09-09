
<div id="cover-carousel" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="{{ asset('assets/img/book.png') }}" alt="Books">
      <div class="carousel-caption">
        <h1 class='page-heading'>Welcome to Livrogo!</h1>
        <p>Create your own Book club or join an existing one. Share books and Enjoy reading.</p>
        <span  class=".hidden-xs .hidden-sm"><blockquote>A book is a device to ignite the imagination.<small>Alan Bennett</small></blockquote></span>
        <p>
          @if(Auth::check())
            <a class="btn btn-default btn-lg" href="{{ route('bookclubs.index') }}" role="button">Browse Book Clubs</a>
          @else
            <a class="btn btn-default btn-lg" href="{{ url('auth/register') }}" role="button">Sign Up</a>
            <p><small>or</small></p>
            <a class="btn btn-lg sign-in" href="{{ url('auth/login') }}" role="button">Sign In</a>
          @endif
      </div>
    </div>
  </div>
</div>

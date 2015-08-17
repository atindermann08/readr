
<div id='jumbotron' class="jumbotron">
  <div class='container'>
  <h1>Welcome to Livrogo!</h1>
  <p>Create your own Book club or join an existing one. Share books and Enjoy reading.</p>
  <blockquote><p>A book is a device to ignite the imagination.</p><p><small>Alan Bennett</small></p></blockquote>
  <p>
    @if(Auth::check())
      <a class="btn btn-primary btn-lg" href="{{ route('bookclubs.index') }}" role="button">Browse Book Clubs</a>
    @else
      <a class="btn btn-primary btn-lg" href="{{ url('auth/register') }}" role="button">Sign Up</a>
    @endif
  </div>
</div>

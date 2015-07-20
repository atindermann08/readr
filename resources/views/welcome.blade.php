@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="jumbotron">
        <h1>Welcome to Livrogo!</h1>
        <p>Create and Join Book clubs and share book with others. Enjoy reading.</p>
        <p>
          @if(Auth::check())
            <a class="btn btn-primary btn-lg" href="{{ route('bookclubs.index') }}" role="button">Browse Book Clubs</a>
          @else
            <a class="btn btn-primary btn-lg" href="{{ url('auth/register') }}" role="button">Sign Up</a>
          @endif
      </div>
    </div>
  </div>
@stop()

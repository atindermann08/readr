@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Book Clubs</h4>
    <hr/>
    <ul>
      @foreach($bookclubs as $bookclub)
        <li>{!! $bookclub->name !!}</li>
      @endforeach
    </ul>
  </div>
</div>
@stop()

@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-7 col-md-offset-1">
    <h3></h3>
    @include('discussions._status_post')
    <h3 class="page-header">
      Discussions
    </h3>
    @foreach($statuses as $status)
      @include('discussions._status_show')
    @endforeach
    <br>
  </div>
</div>
@stop()

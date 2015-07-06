@extends('layouts.default')
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="title"><h1>Laravel 5</h1></div>
      <div class="quote">{{ Inspiring::quote() }}</div>
    </div>
  </div>
@stop()

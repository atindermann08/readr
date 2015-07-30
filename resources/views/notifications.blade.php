@extends('layouts.default')

@section('content')
    <h3>Notifications</h3>
    <hr/>
    <h4>Book Club Joining requests</h4>
    <ul class="list-group">
      @foreach($requests as $request)
        <li class="list-group-item">
          <span class="pull-right">
            <a href="{{ route('bookclubs.requests.accept', $request->id) }}" class='btn'>
              Accept
            </a>
            <a href="{{ route('bookclubs.requests.reject', $request->id) }}" class='btn'>
              Reject
            </a>
          </span>
          {{ $request->bookclub->name }} Joining Request <small>by:{{ $request->requestee->name }} ({{ $request->requestee->email }})</small>
        </li>
      @endforeach
    </ul>
@stop()

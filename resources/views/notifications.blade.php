@extends('layouts.default')

@section('content')
    <h3>Notifications</h3>
    <hr/>
    @if($clubRequests->count())
      <h4>Book Club Joining requests</h4>
      <ul class="list-group">
        @foreach($clubRequests as $request)
          <li class="list-group-item">
            <span class="pull-right">
              <a href="{{ route('bookclubs.requests.accept', $request->id) }}" class='btn'>
                Accept
              </a>
              <a href="{{ route('bookclubs.requests.reject', $request->id) }}" class='btn'>
                Reject
              </a>
            </span>
            <a href='{{ route("bookclubs.show", $request->bookclub->id)}}'>
            {{ $request->bookclub->name }}
          </a>
            Joining Request <small>by:{{ $request->requestee->name }} ({{ $request->requestee->email }})</small>
          </li>
        @endforeach
      </ul>
    @endif
    @if($bookRequests->count())
      <h4>Book requests from BookClubs</h4>
      <ul class="list-group">
        @foreach($bookRequests as $request)
          <li class="list-group-item">
            <span class="pull-right">
              <a href="{{ route('bookclubs.books.requests.accept', $request->id) }}" class='btn'>
                Accept
              </a>
              <a href="{{ route('bookclubs.books.requests.reject', $request->id) }}" class='btn'>
                Reject
              </a>
            </span>
            <a href='{{ route("bookclubs.books.show", [$request->bookclub->id, $request->book->id])}}'>
              {{ $request->book->title }} Book
              </a> in
            <a href='{{ route("bookclubs.show", $request->bookclub->id)}}'>
              {{ $request->bookclub->name }} BookClub
              </a>
            <small> Requested by:{{ $request->requestee->name }} ({{ $request->requestee->email }})</small>
          </li>
        @endforeach
      </ul>
    @endif
@stop()

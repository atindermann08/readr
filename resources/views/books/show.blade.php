@extends('layouts.default')

@section('content')
  @include('partials._showbook', ['page' => 'books'])
  <hr/>
  <h4>Book Clubs</h4>
  <ul class="list-group">
    @foreach($bookclubs as $bookclub)
      <li class="list-group-item">

          <span class="pull-right">
            <a href="{{ route('bookclubs.books.remove', [$bookclub->id, $book->id]) }}" class=''>
              Remove from BookClub
            </a>
          </span>
        <a href="{{ route('bookclubs.show', $bookclub->id) }}">{{ $bookclub->name }}</a> <small>(created by: {{ $bookclub->admin->name }} )</small>
      </li>
    @endforeach
  </ul>
@stop()

@extends('layouts.default')

@section('content')
  @include('partials._showbook')
  <hr/>
  <h4>Book Owners</h4>
  <ul class="list-group">
    @foreach($book->bookclubs as $bookclub)
      <li class="list-group-item">

          <span class="pull-right">
            <a href="{{ route('bookclubs.books.remove', [$bookclub->id, $book->id]) }}" class=''>
              Remove from BookClub
            </a>
          </span>
        {{ $bookclub->name }} <small>(created by: {{ $bookclub->admin->name }} )</small>
      </li>
    @endforeach
  </ul>
@stop()

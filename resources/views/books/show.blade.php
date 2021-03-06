@extends('layouts.default')

@section('content')
<div class="page-header">
  <h3>{{ $book->title }} Details</h3>
</div>
  @include('partials._showbook', ['page' => 'books'])
  <hr/>
  <h4>Book Clubs</h4>
  <ul class="list-group">
    @foreach($bookclubs as $bookclub)
      <li class="list-group-item well">
          <span class="pull-right">
            @unless(auth()->user()->isBorrowed($bookclub->id, $book->id))
              <a href="{{ route('bookclubs.books.remove', [$bookclub->id, $book->id]) }}" class='btn'>
                Remove from BookClub
              </a>
            @endunless
          </span>
          <span class="pull-right">
            @if(auth()->user()->isBorrowed($bookclub->id, $book->id))
              <a href="{{ route('bookclubs.books.received', [$bookclub->id, $book->id, auth()->user()->id]) }}" class='btn'>
                Received Back
              </a>
            @else
              {!! Form::open(['route' => ['bookclubs.books.status.update', $bookclub->id, $book->id], 'method' => 'put']) !!}
                {!! Form::select('book_status', $book_statuses, $bookclub->bookStatus($book->id)->id, ['class' => 'single-select', 'onchange' => 'this.form.submit()' ]) !!}
              {!! Form::close() !!}
            @endif
          </span>
        <a href="{{ route('bookclubs.show', $bookclub->id) }}">{{ $bookclub->name }}</a> <small>(created by: {{ $bookclub->admin->name }} )</small>
      </li>
    @endforeach
  </ul>
@stop()

@extends('layouts.default')

@section('content')
    <h3>My Library</h3>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
    <div class="row">
      {!! Form::open(['route' => 'books.store']) !!}
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::select('titles[]', $books ,null, ['class' => 'form-control book-title-select','placeholder' => 'Book Title', 'multiple']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
          </div>
        </div>
      {!! Form::close() !!}
    </div>
    <hr/>
    @if($books->count() == 0)
      No Books Available at the moment.
    @else
      @foreach ($mybooks->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                  @include('partials._showbook',['statuses' => collect([]), 'page' => 'books'])
                  <hr>
              </div>
            @endforeach
        </div>
        @endforeach
      @endif
      <hr/>
      <div class="row">
        <div class="col-md-6">
          <h3>Borrowed Books</h3>
          <ul class="list-group">
            @foreach($borrowed_books as $book)
              <li class="list-group-item">
                <a href='{{ route("books.show", [$book->id])}}'>
                  {{ $book->title }}
                </a> Borrowed from {{ \App\User::find($book->pivot->owner_id)->name }} in BookClub
                <a href="{{ route('bookclubs.books.show', [ $book->pivot->book_club_id, $book->id]) }}">
                  {{ \App\BookClub::find($book->pivot->book_club_id)->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="col-md-6">
          <h3>Books Shared with others</h3>
          <ul class="list-group">
            @foreach($given_books as $book)
              <li class="list-group-item">
                <a href='{{ route("books.show", [$book->id])}}'>
                  {{ $book->title }}
                </a> Shared with {{ \App\User::find($book->pivot->user_id)->name }} in BookClub
                <a href="{{ route('bookclubs.books.show', [ $book->pivot->book_club_id, $book->id]) }}">
                  {{ \App\BookClub::find($book->pivot->book_club_id)->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
@stop()

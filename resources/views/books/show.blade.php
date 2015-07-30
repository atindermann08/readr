@extends('layouts.default')

@section('content')
  @include('partials._showbook')
  <hr/>
  <h4>Book Owners</h4>
  <ul class="list-group">
    @foreach($book->owners as $owner)
      <li class="list-group-item">
        @unless($owner->id == auth()->user()->id)
          <span class="pull-right">
            <a href="{{ route('books.request', $book->id) }}" class=''>
              Request Book
            </a>
          </span>
        @endunless
        {{ $owner->name }} ({{ $owner->email }})
      </li>
    @endforeach
  </ul>
@stop()

@extends('layouts.default')

@section('content')

@include('partials._showbookclub')
  <hr/>
  @include('partials._showbook')
  <hr/>
  <ul class="list-group">
    @foreach($book->owners as $owner)
      <li class="list-group-item">
        @unless($owner->id == auth()->user()->id)
          @if(auth()->user()->isMember($bookclub->id))
            <span class="pull-right">
              <a href="{{ route('bookclubs.books.requestbook', [$bookclub->id, $book->id]) }}" class=''>
                Request Book
              </a>
            </span>
          @endif
        @endunless
        {{ $owner->name }} ({{ $owner->email }})
      </li>
    @endforeach
  </ul>
@stop()

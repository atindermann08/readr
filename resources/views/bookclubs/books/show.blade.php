@extends('layouts.default')

@section('content')

@include('partials._showbookclub')
  <hr/>
  @include('partials._showbook', ['page' => 'bookclub'])
  <hr/>
  <h4>Book Owners</h4>
  <ul class="list-group">
    @foreach($book->memberOwners($bookclub->id) as $owner)
      <li class="list-group-item">
        @if(auth()->user()->isMember($bookclub->id))
          <span class="pull-right">
            @if($owner->id == auth()->user()->id)
              {!! Form::open(['route' => ['bookclubs.books.status.update', $bookclub->id, $book->id], 'method' => 'put']) !!}
                {!! Form::select('book_status', $book_statuses, $bookclub->bookStatus($book->id)->id, ['class' => 'single-select', 'onchange' => 'this.form.submit()' ]) !!}
              {!! Form::close() !!}
            @elseif(auth()->user()->hasBorrowedBook($bookclub->id, $book->id))
              <span class='btn'>
                Borrowed
              </span>
            @elseif($owner->isBorrowed($bookclub->id, $book->id))
              <span class='btn'>
                Not Available
              </span>
            @elseif(auth()->user()->isBookRequested($bookclub->id, $book->id))
              <a href="{{ route('bookclubs.books.requests.cancel', auth()->user()->bookRequest($bookclub->id, $book->id)->id) }}" class=''>
                Cancel Request
              </a>
            @else
              <a href="{{ route('bookclubs.books.requestbook', [$bookclub->id, $book->id, $owner->id]) }}" class=''>
                Request Book
              </a>
            @endif
          </span>
        @endif
        {{ $owner->name }} ({{ $owner->email }})
      </li>
    @endforeach
  </ul>
@stop()

@extends('layouts.default')

@section('content')
    <h3>Books</h3>
    <hr/>
    @if($books->count() == 0)
      No Books Available at the moment.
    @else
      @foreach ($books->chunk(2) as $chunk)
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
@stop()

@extends('layouts.default')

@section('content')
    @include('partials._showbookclub')
      <hr/>
      @foreach ($bookclub->books->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                @include('partials._showbook',['statuses' => $book->clubstatus()])
                  <hr>
              </div>
            @endforeach
        </div>
      @endforeach
@stop()

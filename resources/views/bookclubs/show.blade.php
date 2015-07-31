@extends('layouts.default')

@section('content')
    @include('partials._showbookclub')
      <hr/>
      <div class="row">
        {!! Form::open(['route' => ['bookclubs.books.store', $bookclub->id]]) !!}
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::select('bookIds[]', $books ,null, ['class' => 'form-control dropdown book-title-select-book-club' , 'multiple']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::submit('Add Books', ['class' => 'btn btn-primary']) !!}
          </div>
        </div>
        {!! Form::close() !!}
      </div>
      @foreach ($bookclub->books->unique()->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                @include('partials._showbook',['statuses' => $book->clubstatus($bookclub->id), 'page' => 'bookclub'])
                  <hr>
              </div>
            @endforeach
        </div>
      @endforeach
@stop()

@extends('layouts.default')

@section('content')
<div class="page-header">
    <h3>{{ $bookclub->name }} Details </h3>
</div>
    @include('partials._showbookclub')
      <hr/>
      @if(auth()->check() && (auth()->user()->isMember($bookclub->id)))
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
      @endif
      @foreach ($bookclub->books->unique()->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                @include('partials._showbook',['statuses' => $book->clubStatus($bookclub->id), 'page' => 'bookclub'])
              </div>
            @endforeach
          </div>
          <hr>
      @endforeach
@stop()

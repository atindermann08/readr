@extends('layouts.default')

@section('content')

    <h3>Add Book to your library</h3>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
      {!! Form::open(['route' => 'books.store']) !!}
        <div class="form-group">
          {!! Form::label('titles', 'Title') !!}
          {!! Form::select('titles[]', $books ,null, ['class' => 'form-control multi-select','placeholder' => 'Book Title', 'multiple']) !!}
        </div>
        {{--
        <div class="form-group">
          {!! Form::label('description', 'Description') !!}
          {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3,'placeholder' => 'Book description maximum 10 characters'])  !!}
        </div>
        <div class="form-group">
          {!! Form::label('author', 'Author') !!}
          {!! Form::text('author' ,null, ['class' => 'form-control','placeholder' => 'Author Name (Spearate by comma if multiple)']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('publisher', 'Publisher') !!}
          {!! Form::text('publisher' ,null, ['class' => 'form-control','placeholder' => 'Book Publisher']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category', 'Category') !!}
          {!! Form::text('category' ,null, ['class' => 'form-control','placeholder' => 'Book Category']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('language', 'Language') !!}
          {!! Form::text('language' ,null, ['class' => 'form-control','placeholder' => 'Book Langugae']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('release_date', 'Release Date') !!}
          {!! Form::input('date', 'release_date', null, ['class' => 'form-control','placeholder'=>'MM-DD-YYYY']) !!}
        </div>--}}
        <div class="form-group">
          {!! Form::label('bookclubs', 'Add Book to Book Clubs') !!}
          {!! Form::select('bookclubs[]', $bookclubs ,null, ['class' => 'form-control dropdown multi-select-book-club' , 'multiple', 'placeholder' => 'Add books to Book Clubs']) !!}
        </div>
        {{--
        <div class="form-group">
          {!! Form::label('image', 'Photo') !!}
          {!! Form::file('image', ['class' => '']) !!}
        </div>
        --}}
        <div class="form-group">
          {!! Form::submit('Add', ['class' => 'form-control btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
@stop()


{{--
  //Add book using bby selecting from already available attributes or by adding new

  {!! Form::open(['route' => 'books.store']) !!}
    <div class="form-group">
      {!! Form::label('title', 'Title') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('description', 'Description') !!}
      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('author', 'Author') !!}
      {!! Form::select('author', $authors ,null, ['class' => 'form-control dropdown']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('publisher', 'Publisher') !!}
      {!! Form::select('publisher', $publishers ,null, ['class' => 'form-control dropdown']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('category', 'Category') !!}
      {!! Form::select('category', $categories ,null, ['class' => 'form-control dropdown']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('language', 'Language') !!}
      {!! Form::select('language', $languages ,null, ['class' => 'form-control dropdown']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('release_date', 'Release Date') !!}
      {!! Form::input('date', 'release_date', null, ['class' => 'form-control','placeholder'=>'MM-DD-YYYY']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('photo', 'Photo') !!}
      {!! Form::file('photo', ['class' => '']) !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Add', ['class' => 'form-control btn btn-primary']) !!}
    </div>
  {!! Form::close() !!}

--}}

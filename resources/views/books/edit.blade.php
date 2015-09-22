@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h4>Add Book</h4>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
      {!! Form::open(['files' => 'true','route' => ['books.update',$book->id],'method' => 'PATCH']) !!}
        <div class="form-group">
          {!! Form::label('title', 'Title') !!}
          {!! Form::label('title', $book->title, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('description', 'Description') !!}
          {!! Form::textarea('description', $book->description, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('authors', 'Authors') !!}
          {!! Form::select('authors[]', $authors, $book_authors, ['class' => 'form-control multi-select-authors','placeholder' => 'Book Title', 'multiple']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('publisher', 'Publisher') !!}
          {!! Form::text('publisher' , isset($book->publisher->name)?$book->publisher->name:null , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category', 'Category') !!}
          {!! Form::text('category' ,isset($book->category->name)?$book->category->name:null , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('language', 'Language') !!}
          {!! Form::text('language' , isset($book->language->name)?$book->language->name:null , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('release_date', 'Release Date') !!}
          {!! Form::input('date', 'release_date', isset($book->release_date)?$book->release_date:null , ['class' => 'form-control','placeholder'=>'MM-DD-YYYY']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('image', 'Photo') !!}
          {!! Form::file('image', ['class' => '']) !!}
        </div>
        <div class="form-group">
          {!! Form::submit('Add', ['class' => 'form-control btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
  </div>
</div>
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

@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h4>Add Book</h4>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
      {!! Form::open(['route' => ['books.update',$book->id],'method' => 'PATCH']) !!}
        <div class="form-group">
          {!! Form::label('title', 'Title') !!}
          {!! Form::text('title', $book->title, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('description', 'Description') !!}
          {!! Form::textarea('description', $book->description, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('author', 'Author') !!}
          {!! Form::text('author' ,$book->author->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('publisher', 'Publisher') !!}
          {!! Form::text('publisher' ,$book->publisher->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category', 'Category') !!}
          {!! Form::text('category' ,$book->category->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('language', 'Language') !!}
          {!! Form::text('language' ,$book->language->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('release_date', 'Release Date') !!}
          {!! Form::input('date', 'release_date', $book->release_date, ['class' => 'form-control','placeholder'=>'MM-DD-YYYY']) !!}
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

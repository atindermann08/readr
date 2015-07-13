@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h4>Create Book</h4>
    <hr/>
      {!! Form::open() !!}
        <div class="form-group">
          {!! Form::label('title', 'Title') !!}
          {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('description', 'Description') !!}
          {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('author', 'Author') !!}
          {!! Form::text('author', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('publisher', 'Publisher') !!}
          {!! Form::text('publisher', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category', 'Category') !!}
          {!! Form::text('category', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('language', 'Language') !!}
          {!! Form::text('language', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('release_date', 'Release Date') !!}
          {!! Form::text('release_date', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('photo', 'Photo') !!}
          {!! Form::file('photo', ['class' => '']) !!}
        </div>
        <div class="form-group">
          {!! Form::submit('Create', ['class' => 'form-control btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
  </div>
</div>
@stop()

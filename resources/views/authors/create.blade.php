@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Add Author</h4>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
    {!! Form::open(['route' => 'authors.store']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('bio', '') Details!!}
        {!! Form::textarea('bio', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('image', 'Photo') !!}
        {!! Form::file('image', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop()

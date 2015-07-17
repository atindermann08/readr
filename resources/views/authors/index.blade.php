@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Authors</h4>
    <hr/>
    @include('layouts.partials._errors')
    {!! Form::open(['route' => 'authors.store', 'class' => 'form-inline']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('bio', 'Details') !!}
        {!! Form::text('bio', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
      </div>
      <br/><br/>
      <div class="form-group">
        {!! Form::label('image', 'Photo') !!}
        {!! Form::file('image', null, ['class' => '']) !!}
      </div>
    {!! Form::close() !!}
    <hr/>
    <ul class="list-group">
      @foreach($authors as $author)
        <li class="list-group-item">
          {{$author->name}}
          <a class="btn btn-primary badge" href="{{route('authors.edit',$author->id)}}">edit</a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@stop()

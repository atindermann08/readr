@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Languges</h4>
    <hr/>
    @include('layouts.partials._errors')
    {!! Form::open(['route' => 'languages.store', 'class' => 'form-inline']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
    <hr/>
    <ul class="list-group">
      @foreach($languages as $language)
        <li class="list-group-item">
          {{$language->name}}
          <a class="btn btn-primary badge" href="{{route('languages.edit',$language->id)}}">edit</a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@stop()

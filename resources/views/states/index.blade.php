@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>States</h4>
    <hr/>
    @include('layouts.partials._errors')
    {!! Form::open(['route' => 'states.store', 'class' => 'form-inline']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('country', 'Country') !!}
        {!! Form::select('country', $countries,null, ['class' => 'form-control dropdown']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
    <hr/>
    <ul class="list-group">
      @foreach($states as $state)
        <li class="list-group-item">
          {{$state->name}},
          {{$state->country->name}}
          <a class="btn btn-primary badge" href="{{route('states.edit',$state->id)}}">edit</a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@stop()

@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Edit State</h4>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
    {!! Form::open(['route' => ['states.update',$state->id], 'method' => 'PUT']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $state->name, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('country', 'Country') !!}
        {!! Form::select('country', $countries,null, ['class' => 'form-control dropdown']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop()

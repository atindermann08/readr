@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Edit Publisher</h4>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
    {!! Form::open(['route' => ['publishers.update', $publisher->id],'method' => 'PUT']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $publisher->name, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop()

@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h4>Countries</h4>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
    {!! Form::open(['route' => 'countries.store', 'class' => 'form-inline']) !!}
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
      @foreach($countries as $country)
        <li class="list-group-item">
          {{$country->name}}
          <a class="btn btn-primary badge" href="{{route('countries.edit',$country->id)}}">edit</a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@stop()

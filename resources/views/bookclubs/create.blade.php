@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h4>Create Book Club</h4>
    <hr/>
      @include('layouts.partials._errors')
      {!! Form::open(['route' => 'bookclubs.store']) !!}
        <div class="form-group">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('description', 'Description') !!}
          {!! Form::textarea('description', null, ['class' => 'form-control' ,'rows' => '3']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('rules', 'Rules') !!}
          {!! Form::textarea('rules' ,null, ['class' => 'form-control','rows' => '5']) !!}
        </div>
        {{--
        <div class="form-group">
          {!! Form::label('image', 'Photo') !!}
          {!! Form::file('image', ['class' => '']) !!}
        </div>
        --}}
        <div class="form-group">
          {!! Form::submit('Create', ['class' => 'form-control btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
  </div>
</div>
@stop()

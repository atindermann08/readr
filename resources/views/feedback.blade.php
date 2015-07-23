@extends('layouts.default')

@section('content')
    <h3>Provide Feedback</h3>
    <hr/>
      @include('flash::message')
      {{-- @include('layouts.partials._errors') --}}
      {!! Form::open(['route' => 'feedback.store']) !!}
        <div class="form-group">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('email', 'Email') !!}
          {!! Form::text('email', $user->email, ['class' => 'form-control' ,'rows' => '3']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('feedback', 'Feedback') !!}
          {!! Form::textarea('feedback' ,null, ['class' => 'form-control','rows' => '5']) !!}
        </div>
        <div class="form-group">
          {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
@stop()

@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h3>Register</h3>
    <hr />
        @include('layouts.partials._errors')
    {!!Form::open()!!}
      <div class="form-group">
        {!! Form::label('name','Name') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email','Email') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
      </div>
      <!-- <div class="form-group">
        {!! Form::label('mobile','Mobile') !!}
        {!! Form::text('mobile',null,['class'=>'form-control']) !!}
      </div> -->
      <div class="form-group">
        {!! Form::label('password','Password') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('password_confirmation','Confirm Password') !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit',['class'=>'form-control btn btn-primary']) !!}
      </div>

    {!!Form::close()!!}
  </div>
</div>

@stop()

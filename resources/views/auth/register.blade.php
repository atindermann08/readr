@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h3>Register</h3>
    <hr />
    {{-- @include('layouts.partials._errors') --}}
    {!!Form::open()!!}
      <div class="form-group">
        {!! Form::label('name','Name') !!}
        {!! Form::text('name',null,['class'=>'form-control', 'placeholder' => 'Name e.g "Elon Musk"']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email','Email') !!}
        {!! Form::text('email',null,['class'=>'form-control', 'placeholder' => 'Email e.g "musk@teslamotors.com"']) !!}
      {{--
        <div class="input-group">
          <input type="text" class="form-control" name='email' id='email' placeholder="Email Address" aria-describedby="basic-addon2">
          <span class="input-group-addon" id="basic-addon2">@infosys.com</span>
        </div>
        --}}
      </div>
      <div class="form-group">
        {!! Form::label('password','Password') !!}
        {!! Form::password('password',['class'=>'form-control', 'placeholder' => 'Password']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('password_confirmation','Confirm Password') !!}
        {!! Form::password('password_confirmation',['class'=>'form-control', 'placeholder' => 'Confirm password']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Submit',['class'=>'form-control btn btn-primary']) !!}
      </div>

    {!!Form::close()!!}
  </div>
</div>

@stop()

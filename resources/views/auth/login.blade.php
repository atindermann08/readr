@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h3>Login</h3>
    <hr />
        @include('layouts.partials._errors')
    {!!Form::open()!!}
      <div class="form-group">
        {!! Form::label('email','Email') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('password','Password') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember Me
						</label>
				</div>
			</div>
      <div class="form-group">
        {!! Form::submit('Login',['class'=>'form-control btn btn-primary']) !!}
        <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
      </div>

    {!!Form::close()!!}
  </div>
</div>

@stop()

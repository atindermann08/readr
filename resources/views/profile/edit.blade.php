@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h3 class='page-header'>Profile</small></h3>
<<<<<<< HEAD
    <img src="{{ asset($profile->image) }}" alt="{{ $user->name }}" class='profile-img'>  </img>
=======
    <img src="{{ $profile->image }}" alt="{{ $user->name }}" class='profile-img'>  </img>
>>>>>>> status post and view
    {!! Form::open(['method'=>'PUT', 'files' => 'true', 'route' => ['profile.update', $profile->id]]) !!}
      <div class="form-group">
        <div class="fileUpload btn btn-default">
            <span>Change Profile Image</span>
            <input name="image" id='image' type="file" class="change-profile-image" />
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::label('email', $user->email, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('mobile', 'Mobile') !!}
        {!! Form::text('mobile', $profile->mobile, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('about', 'About') !!}
        {!! Form::textarea('about', $profile->about, ['class' => 'form-control' ,'rows' => '3']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('profile.index') }}" class='btn btn-link'>Cancel</a>
      </div>
    {!! Form::close() !!}

  </div>
</div>
@stop()

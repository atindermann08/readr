@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h3 class='page-header'>Profile <small><a href="{{ route('profile.edit', $profile->id) }}">edit</a></small></h3>
    <img src="{{ asset($profile->image) }}" alt="{{ $user->name }}" class='profile-img'>  </img>

    <p><b>Name:</b> {{ $user->name }} </p>
    <p><b>Email:</b> {{ $user->email }} </p>
    <p><b>Mobile:</b> {{ $profile->mobile }} </p>
    <p><b>About:</b> {{ $profile->about }} </p>
  </div>
</div>
@stop()

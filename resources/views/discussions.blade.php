@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-7 col-md-offset-1">
    <h3></h3>
    <div class='status-post-form'>
      {!! Form::open(['route' => 'discussions.store']) !!}
        <div class="form-group">
          {!! Form::textarea('body', null,
                  [
                    'class' => 'form-control status-post-area' ,
                    'rows' => '2',
                    'placeholder' => 'What going on...',
                    'required' => 'required'
                    ]) !!}
        </div>
        <div class="form-group status-post-submit">
          {!! Form::submit('Post', ['class' => 'pull-right btn btn-deafult status-post-submit-btn']) !!}
        </div>
      {!! Form::close() !!}
    </div>
    <h3 class="page-header">
      Discussions
    </h3>
    @foreach($statuses as $status)
      <div class="media status">
        <div class="media-left">
            <img class="media-object status-profile-img" src="{{ $status->user->profile->image }}"
            alt="{{ $status->user->name }}">
        </div>
        <div class="media-body">
          <h4 class="media-heading">{{ $status->user->name }}</h4>
          <p><small>{{ $status->created_at->diffForHumans() }}</small></p>
          {{ $status->body }}
        </div>
      </div>
    @endforeach
    <br>
  </div>
</div>

@stop()

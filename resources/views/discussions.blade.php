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
            <img class="media-object status-profile-img" src="{{ $status->user->profile->thumb_image }}"
            alt="{{ $status->user->name }}">
        </div>
        <div class="media-body">
          <h4 class="media-heading">{{ $status->user->name }}</h4>
          {{ $status->body }}
          <small>
            <div class='status-action'>
              @if($status->isLiked())
                <a href="{{ route('status.unlike', $status->id)}}">Unlike</a>
              @else
                <a href="{{ route('status.like', $status->id)}}">Like</a>
              @endif
              @if($status->likes()->count())
                <small>{{ $status->likes()->count() }} People like this.</small>
              @else
                <small>Be the first to like this.</small>
              @endif
              <small><i>{{ $status->created_at->diffForHumans() }}</i></small>
            </div>
          </small>
          <div class='status-comment'>
            @if($status->comments()->count() == 1)
              <small>{{ $status->comments()->count() }} comment.</small>
            @elseif($status->comments()->count())
              <small>{{ $status->comments()->count() }} comment.</small>
            @else
              <small>Be the first to reply.</small>
            @endif

            @foreach($status->comments as $comment)
              <div class="media comment">
                <div class="media-left">
                    <img class="media-object status-profile-img" src="{{ $status->user->profile->thumb_image }}"
                    alt="{{ $status->user->name }}">
                </div>
                <div class="media-body">
                  <b class="media-heading">{{ $comment->user->name }}</b>

                  {{ $comment->body }}
                  <div class='comment-action'>
                    <small>
                      @if($comment->isLiked())
                        <a href="{{ route('comments.unlike', $comment->id)}}">Unlike</a>
                      @else
                        <a href="{{ route('comments.like', $comment->id)}}">Like</a>
                      @endif
                      @if($comment->likes()->count())
                        <small>{{ $comment->likes()->count() }} People like this.</small>
                      @else
                        <small>Be the first to like this.</small>
                      @endif
                      <i>{{ $comment->created_at->diffForHumans() }}</i>
                    </small>
                  </div>
                </div>
              </div>
            @endforeach
            <div class="media comment-post">
              <div class="media-left">
                  <img class="media-object status-profile-img" src="{{ auth()->user()->profile->thumb_image }}"
                  alt="{{ auth()->user()->name }}">
              </div>
              <div class="media-body">
                  {!! Form::open(['method'=>'POST', 'route' => ['discussions.comments.store',$status->id]]) !!}
                    <div class="form-group">
                      {!! Form::textarea('body', null,
                              [
                                'class' => 'form-control comment-post-area' ,
                                'rows' => '1',
                                'placeholder' => 'Reply...',
                                'required' => 'required'
                                ]) !!}
                    </div>
                    <div class="form-group comment-post-submit">
                      {!! Form::submit('Reply', ['class' => 'pull-right btn btn-deafult comment-post-submit-btn']) !!}
                    </div>
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    <br>
  </div>
</div>

@stop()

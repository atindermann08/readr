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
                    'class' => 'form-control comment-post-area',
                    'id' => 'comment-box',
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

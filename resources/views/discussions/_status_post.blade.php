<div class="media status-post-form">
  <div class="media-left status-profile-container">
      <img class="media-object status-profile-img" src="{{ auth()->user()->profile->thumb_image }}"
      alt="{{ auth()->user()->name }}">
  </div>
  <div class="media-body">
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

  </div><div class="form-group status-post-submit">
    {!! Form::submit('Post', ['class' => 'pull-right btn btn-deafult status-post-submit-btn']) !!}
  </div>
{!! Form::close() !!}
</div>

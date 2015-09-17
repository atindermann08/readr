<div class="media status">
  <div class="media-left">
      <img class="media-object status-profile-img" src="{{ $status->user->profile->thumb_image }}"
      alt="{{ $status->user->name }}">
  </div>
  <div class="media-body">
    <h4 class="media-heading">{{ $status->user->name }}</h4>
    {{ $status->body }}
    @include('discussions.status._action_bar')
    <div class='status-comment'>
      @if($status->comments()->count() == 1)
        <small>{{ $status->comments()->count() }} comment.</small>
      @elseif($status->comments()->count())
        <small>{{ $status->comments()->count() }} comments.</small>
      @else
        <small>Be the first to reply.</small>
      @endif

      @foreach($status->comments as $comment)
        @include('discussions.comments._show')
      @endforeach
      @include('discussions.comments._submit')
    </div>
  </div>
</div>

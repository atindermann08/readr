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
        <i><small>{{ $comment->created_at->diffForHumans() }}</small></i>
      </small>
    </div>
  </div>
</div>

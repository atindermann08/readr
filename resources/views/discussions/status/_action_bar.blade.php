<div class='status-action'>
  <small>
    @if($status->isLiked())
      <a href="{{ route('status.unlike', $status->id)}}">Unlike</a>
    @else
      <a href="{{ route('status.like', $status->id)}}">Like</a>
    @endif
    @if($status->likes()->count())
      {{ $status->likes()->count() }} People like this.
    @else
      Be the first to like this.
    @endif
    <i>{{ $status->created_at->diffForHumans() }}</i>
  </small>  
</div>

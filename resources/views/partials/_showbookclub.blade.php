<div class="media">
  <div class="media-left">
    <a href="{{route('bookclubs.show',$bookclub->id)}}">
        <i class='fa fa-leanpub fa-4x  book-default-pic img-round'></i>
    </a>
  </div>
  <div class="media-body">
    <h3 class="media-heading">{!! link_to_route('bookclubs.show',$bookclub->name,$bookclub->id) !!}</h3>
    <p>Description: {{$bookclub->description}}</p>
    <small>{{count($bookclub->members)}} Members,</small>
    <small>{{count($bookclub->books)}} Books</small>
  </div>
  <div class="media-right">
    @if(auth()->check())
      @if(auth()->user()->isClubAdmin($bookclub->id))
        <a href="{{ route('bookclubs.edit', $bookclub->id) }}" class='btn pull-right'>
          <i class='fa fa-edit'></i>
        </a><br><br>
      @endif
      <p class='pull-right'>
        @if(auth()->user()->isMember($bookclub->id))
          <span class='btn btn-default disabled'>Already Member</span>
        @else
          @if(auth()->user()->isJoinRequestSent($bookclub->id))
            <a href="{{ route('bookclubs.requests.cancel', auth()->user()->joinRequest($bookclub->id)->id) }}" class='btn btn-danger'>
              Cancel Join Request
            </a>
          @else
            @if($bookclub->is_closed)
              <a href="{{ route('bookclubs.join', $bookclub->id) }}" class='btn btn-primary'>Send Join Request</a>
            @else
              <a href="{{ route('bookclubs.join', $bookclub->id) }}" class='btn btn-success'>Join Club</a>
            @endif
          @endif
        @endif
      @endif
    </p>
  </div>
</div>

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
    <p class='pull-right'>
      @unless(auth()->user()->isMember($bookclub->id))
        @if($bookclub->is_closed)
          <a href="{{ route('bookclubs.join', $bookclub->id) }}" class='btn btn-primary'>Send Join Request</a>
        @else
          <a href="{{ route('bookclubs.join', $bookclub->id) }}" class='btn btn-primary'>Join Club</a>
        @endif
      @endunless
    </p>
  </div>
  <div class="media-right">
    @if(auth()->user()->id == $bookclub->admin->id)
      <a href="{{ route('bookclubs.edit', $bookclub->id) }}" class='btn'>
        <i class='fa fa-edit'></i>
      </a>
    @endif
  </div>
</div>

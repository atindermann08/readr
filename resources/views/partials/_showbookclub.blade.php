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
    <small>@if($bookclub->is_closed) 'Closed Club' @else 'Open Club' @endif</small>
  </div>
  @if(auth()->user()->id == $bookclub->admin->id)
    <div class="media-right">
      <a href="{{ route('bookclubs.edit', $bookclub->id) }}" class='btn'>
        <i class='fa fa-edit'></i>
      </a>
    </div>
  @endif
</div>

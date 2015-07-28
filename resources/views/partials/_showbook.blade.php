<div class="media book-view ">
  <div class="media-left">
    <a href="{{route('books.show',$book->id)}}">
        <i class='fa fa-leanpub fa-4x book-default-pic'></i>
    </a>
  </div>
  <div class="media-body">
    <h3 class="media-heading">
      {{-- @if(isset($book_clickable)) --}}
        {!! link_to_route('books.show',$book->title,$book->id) !!}
      {{-- @else
        {{ $book->title }}
      @endif --}}
    </h3>
    <small>
      by:
        @forelse($book->authors as $key => $author)
            @unless($key == 0) , @endunless
            {{$author->name}}
        @empty
          Not Available
        @endforelse
    </small>
    <p>Description: {{$book->description or 'Not Available'}}</p>
    <small>@if(isset($book->language->name)) Language: {{$book->language->name }} , @endif</small>
    <small>@if(isset($book->category->name)) Category: {{$book->category->name }} , @endif</small>
    <small>@if(isset($book->publisher->name)) Publisher: {{$book->publisher->name }} , @endif</small>
    <small>Status:
      @forelse($statuses as $count=>$status)
        {{ $status }} {{$count}}
      @empty
        None Available
      @endforelse
    </small>
  </div>
  <div class="media-right">
    <a href="{{ route('books.edit', $book->id) }}" class='btn'>
        <i class='fa fa-edit'></i>
    </a>
  </div>

</div>

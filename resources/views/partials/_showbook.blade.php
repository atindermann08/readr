<div class="media book-view ">
  <div class="media-left">
    <a href="{{route('books.show',$book->id)}}">
        <i class='fa fa-leanpub fa-4x book-default-pic'></i>
    </a>
  </div>
  <div class="media-body">
    <h3 class="media-heading">
      @if(isset($book_clickable))
        {!! link_to_route('books.show',$book->title,$book->id) !!}
      @else
        {{ $book->title }}
      @endif
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
    <p>Description: {{$book->description}}</p>
    <small>Language: {{$book->language->name}},</small>
    <small>Category: {{$book->category->name}},</small>
    <small>Status:
      @forelse($statuses as $count=>$status)
        {{ $status }} {{$count}}
      @empty
        None Available
      @endforelse
    </small>
  </div>
</div>

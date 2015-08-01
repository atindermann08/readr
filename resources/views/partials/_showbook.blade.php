<div class="media book-view ">
  <div class="media-left">
    <a href="{{route('books.show',$book->id)}}">
        <i class='fa fa-leanpub fa-4x book-default-pic'></i>
    </a>
  </div>
  <div class="media-body">
    <h3 class="media-heading">
      @if(isset($show_route) and $show_route == 'bookclubs.books.show' )
        <a href="{{ route($show_route, [$bookclub->id, $book->id]) }}">
          {{ $book->title }}
        </a>
      @else
      <a href="{{ route('books.show', $book->id) }}">
        {{ $book->title }}
      </a>
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
    <p>Description: {{$book->description or 'Not Available'}}</p>
    <small>@if(isset($book->language->name)) Language: {{$book->language->name }}, @endif</small>
    <small>@if(isset($book->category->name)) Category: {{$book->category->name }}, @endif</small>
    <small>@if(isset($book->publisher->name)) Publisher: {{$book->publisher->name }}, @endif</small>
    <small>@if($statuses->count()) Status:
            @forelse($statuses as $status=>$count)
              {{ $count }} {{$status}}
            @empty
              None Available
            @endforelse
          @endif
    </small>
  </div>
  <div class="media-right">
    @if(auth()->check())
      <a href="{{ route('books.edit', $book->id) }}" class='btn'>
          <i class='fa fa-edit'></i>
      </a>
      @if($page == 'books')
        @if(auth()->user()->ownBook($book->id))
          <a href="{{ route('books.removefromlibrary',  $book->id) }}" class='btn'>
              <i class='fa fa-trash'></i>
          </a>
        @endif
      @else
        @if(auth()->user()->ownBookClubBook($bookclub->id, $book->id))
          <a href="{{ route('bookclubs.books.remove', [$bookclub->id, $book->id]) }}" class='btn'>
              <i class='fa fa-trash'></i>
          </a>
        @endif
      @endif
    @endif
  </div>

</div>

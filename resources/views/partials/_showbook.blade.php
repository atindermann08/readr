<div class="media book-view @if($statuses->has('Available')) available @else not-available @endif">
  <div class="media-left">
    <a href="{{route('books.show',$book->id)}}">
        <img src="{{ asset($book->image) }}" alt="book" class='book-img'>  </img>
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
      @if($book->authors()->count())
      by:

        @forelse($book->authors as $key => $author)
            @unless($key == 0) , @endunless
            {{$author->name}}
        @endforeach
      @endif
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
          <i class='fa fa-edit btn btn-default'> Edit</i>
      </a>
      @if($page == 'books')
        @if(auth()->user()->ownBook($book->id))
          <a href="" class='btn' data-toggle="modal" data-target="#confirmationModal{{$book->id}}">
              <i class='fa fa-trash btn btn-default'> Remove</i>
          </a>
        @endif
      @else
        @if(auth()->user()->ownBookClubBook($bookclub->id, $book->id))
          <a href="{{ route('bookclubs.books.remove', [$bookclub->id, $book->id]) }}" class='btn'>
              <i class='fa fa-trash  btn btn-default'> Remove</i>
          </a>
        @endif
      @endif
    @endif
  </div>

</div>


<!-- Modal -->
<div class="modal fade" id="confirmationModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are your sure?</h4>
      </div>
      <div class="modal-body">
        Removing a {{ $book->title }} from your library will also remove it from all your bookclubs. Click remove to proceed.
      </div>
      <div class="modal-footer">
        <a type="button" href="{{ route('books.removefromlibrary',  $book->id) }}" class="btn btn-danger">Remove</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

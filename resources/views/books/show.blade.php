@extends('layouts.default')

@section('content')
    <div class="media">
      <div class="media-left">
          <i class='fa fa-leanpub fa-4x book-default-pic'></i>
      </div>
      <div class="media-body">
        <h3 class="media-heading">{!! $book->title !!}</h3>
        <small>by:  @if( count($book->authors) > 0 )
                      @foreach ($book->authors as $author )
                        {{ $author->name }},
                      @endforeach
                    @else
                      Not Available
                    @endif</small>
        <p>Description: {{$book->description}}</p><br/>
        @unless($user->ownBook($book->id))
          <p>{!! link_to_route('books.addtolibrary','Add to My Library', $book->id, ['class'=>'btn btn-primary']) !!}</p>
        @else
          <p class='' >You own this book</p>
        @endunless
      </div>
    </div>
      <hr/>
@stop()

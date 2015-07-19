@extends('layouts.default')

@section('content')
    <h3>Books</h3>
    <hr/>
    @include('flash::message')
    @foreach($books as $book)
      <div class="media">
        <div class="media-left">
          <a href="{{route('books.show',$book->id)}}">
              <i class='fa fa-leanpub fa-4x book-default-pic'></i>
          </a>
        </div>
        <div class="media-body">
          <h3 class="media-heading">{!! link_to_route('books.show',$book->title,$book->id) !!}</h3>
          <small>by: @foreach($book->authors as $author) {{$author->name}} @endforeach</small>
          <p>Description: {{$book->description}}</p>
          <small>{{count($book->bookclubs)}} Book Clubs,</small>
          <small>Language: {{$book->language->name}},</small>
          <small>Owners: {{ count($book->owners) }}</small>
        </div>
      </div>
    @endforeach
@stop()

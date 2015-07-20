@extends('layouts.default')

@section('content')
    <h3>Book Clubs</h3>
    <hr/>
    @if($bookclubs->count() == 0)
      No Books Available at the moment.
    @else
      @foreach($bookclubs as $bookclub)
        <div class="media">
          <div class="media-left">
            <a href="{{route('bookclubs.show',$bookclub->id)}}">
                <i class='fa fa-leanpub fa-4x book-default-pic'></i>
            </a>
          </div>
          <div class="media-body">
            <h3 class="media-heading">{!! link_to_route('bookclubs.show',$bookclub->name,$bookclub->id) !!}</h3>
            <p>Description: {{$bookclub->description}}</p>
            <small>{{count($bookclub->members)}} Members,</small>
            <small>{{count($bookclub->books)}} Books</small>
          </div>
        </div>
      @endforeach
    @endif
@stop()

@extends('layouts.default')

@section('content')
      <div class="media">
        <div class="media-left">
          <a href="{{route('bookclubs.show',$bookclub->id)}}">
              <i class='fa fa-leanpub fa-4x book-default-pic img-round'></i>
          </a>
        </div>
        <div class="media-body">
          <h3 class="media-heading">{!! $bookclub->name !!}</h3>
          <p>Description: {{$bookclub->description}}</p>
          <small>{{count($bookclub->members)}} Members</small>
          <small>{{count($bookclub->books)}} Books</small><br/><br/>
          @unless($user->isMember($bookclub->id))
            <p>{!! link_to_route('bookclubs.join','Join Club', $bookclub->id, ['class'=>'btn btn-primary']) !!}</p>
          @else
            <p class='' >Already Member</p>
          @endunless
        </div>
      </div>
      <hr/>
      @foreach($bookclub->books as $book)
        @include('partials._showbook')
      @endforeach
@stop()

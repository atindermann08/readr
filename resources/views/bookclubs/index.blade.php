@extends('layouts.default')

@section('content')
    <h3>Book Clubs</h3>
    <hr/>
    @if($bookclubs->count() == 0)
      No BookClubs Available at the moment.
    @else
      @foreach ($bookclubs->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $bookclub)
              <div class="col-md-6">
                  @include('partials._showbookclub')
                  {{--@unless(true)
                    <p>{!! link_to_route('bookclubs.Joinrequest','join', $bookclub->id, ['class'=>'btn btn-primary']) !!}</p>
                  @else
                    <p class=''>Request Pending</p>
                  @endunless--}}
                  <hr>
              </div>
            @endforeach
        </div>
        @endforeach
      @endif
@stop()

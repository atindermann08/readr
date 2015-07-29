@extends('layouts.default')

@section('content')
    @include('partials._showbookclub')
      <hr/>
      @foreach ($bookclub->books->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                @include('partials._showbook',['statuses' => $book->clubstatus()])
                {{--
                @unless(false)
                  <p>{!! link_to_route('bookclubs.requestbook','Request Book', [$bookclub->id, $book->id], ['class'=>'btn btn-primary']) !!}</p>
                @else
                  <p class=''>Request Pending</p>
                @endunless
                --}}
                  <hr>
              </div>
            @endforeach
        </div>
      @endforeach
@stop()

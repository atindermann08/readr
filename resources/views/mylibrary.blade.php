@extends('layouts.default')

@section('content')
    <h3>My Library</h3>
    <hr/>
    @if($books->count() == 0)
      No Books Available at the moment.
    @else
      @foreach ($books->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                  @include('partials._showbook',['statuses' => $book->ownerstatus()])

                  {{--
                  @unless(true)
                    <p>{!! link_to_route('books.request','Request Book', $book->id, ['class'=>'btn btn-primary']) !!}</p>
                  @else
                    <p class=''>Request Pending</p>
                  @endunless
                  --}}
                  
                  <hr>
              </div>
            @endforeach
        </div>
        @endforeach
      @endif
@stop()

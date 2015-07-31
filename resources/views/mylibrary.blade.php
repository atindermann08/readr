@extends('layouts.default')

@section('content')
    <h3>My Library</h3>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
    <div class="row">
      {!! Form::open(['route' => 'books.store']) !!}
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::select('titles[]', $books ,null, ['class' => 'form-control book-title-select','placeholder' => 'Book Title', 'multiple']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
          </div>
        </div>
      {!! Form::close() !!}
    </div>
    <hr/>
    @if($books->count() == 0)
      No Books Available at the moment.
    @else
      @foreach ($mybooks->chunk(2) as $chunk)
          <div class="row">
            @foreach ($chunk as $book)
              <div class="col-md-6">
                  @include('partials._showbook',['statuses' => $book->ownerStatus(), 'page' => 'books'])

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

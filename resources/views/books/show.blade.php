@extends('layouts.default')

@section('content')
  @include('partials._showbook')@unless(false)
    <p>{!! link_to_route('books.request','Request Book', $book->id, ['class'=>'btn btn-primary']) !!}</p>
  @else
    <p class=''>Request Pending</p>
  @endunless
  <hr/>
@stop()

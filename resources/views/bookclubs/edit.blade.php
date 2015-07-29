@extends('layouts.default')

@section('content')
    <h3>Edit BookClub</h3>
    <hr/>
      {!! Form::open(['route' => ['bookclubs.update',$bookclub->id],'method' => 'PATCH']) !!}
      <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', $bookclub->name, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', $bookclub->description , ['class' => 'form-control' ,'rows' => '3']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('rules', 'Rules') !!}
        {!! Form::textarea('rules' , $bookclub->rules , ['class' => 'form-control','rows' => '5']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('books', 'Add Your Books to Book Club') !!}
        {!! Form::select('books[]', $books , $bookclub->books->lists('title'), ['class' => 'form-control dropdown book-title-select' , 'multiple']) !!}
      </div>
      <div class="form-group">
        {!! Form::checkbox('is_closed', '1', $bookclub->is_closed , ['id' => 'is_closed']) !!}
          <label for="is_closed">
              Group is Closed? <small>(Requires request approval to join group)</small>
          </label>
        </input>
      </div>
      {{--
      <div class="form-group">
        {!! Form::label('image', 'Photo') !!}
        {!! Form::file('image', ['class' => '']) !!}
      </div>
      --}}
      <div class="form-group">
        {!! Form::submit('Create', ['class' => 'form-control btn btn-primary']) !!}
      </div>
    {!! Form::close() !!}
@stop()

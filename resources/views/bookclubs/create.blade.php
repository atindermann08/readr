@extends('layouts.default')

@section('content')
    <h3>Create Book Club</h3>
    <hr/>
    {{-- @include('layouts.partials._errors') --}}
      {!! Form::open(['route' => 'bookclubs.store']) !!}
        <div class="form-group">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('description', 'Description') !!}
          {!! Form::textarea('description', null, ['class' => 'form-control' ,'rows' => '3']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('rules', 'Rules') !!}
          {!! Form::textarea('rules' ,null, ['class' => 'form-control','rows' => '5']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('books', 'Add Your Books to Book Club') !!}
          {!! Form::select('books[]', $books ,null, ['class' => 'form-control dropdown book-title-select' , 'multiple']) !!}
        </div>
        <div class="form-group">
          {!! Form::checkbox('is_closed', '1', true, ['id' => 'is_closed']) !!}
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

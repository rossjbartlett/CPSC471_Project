@extends('layouts.app')

@section('content')


    <h1>Add a New Shift</h1>
    <hr>

  
    {!! Form::open(['url'=>'shifts']) !!}
        @include ('shifts.form', ['submitButtonText'=>'Add Shift', 'editFlag' =>'false'])
    {!! Form::close() !!}

    
    @include ('errors.list')

    
@stop

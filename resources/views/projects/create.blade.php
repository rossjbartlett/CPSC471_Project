@extends('layouts.app')

@section('content')


    <h1>Create New Project</h1>
    <hr>


  
    {!! Form::open(['url'=>'projects']) !!}
        @include ('projects.form', ['submitButtonText'=>'Create Project'])
    {!! Form::close() !!}

    
    @include ('errors.list')

    
@stop

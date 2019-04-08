@extends('layouts.app')

@section('content')


    <h1>Create New Equipment</h1>
    <hr>


    {!! Form::open(['url'=>'equipment']) !!}
    @include ('equipment.form', ['submitButtonText'=>'Create Equipment', 'editFlag' =>'false'])
    {!! Form::close() !!}


    @include ('errors.list')


@stop

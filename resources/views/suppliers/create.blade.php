@extends('layouts.app')

@section('content')


    <h1>Create New Supplier</h1>
    <hr>


    {!! Form::open(['url'=>'suppliers']) !!}
    @include ('suppliers.form', ['submitButtonText'=>'Create Supplier', 'editFlag' =>'false'])
    {!! Form::close() !!}


    @include ('errors.list')


@stop

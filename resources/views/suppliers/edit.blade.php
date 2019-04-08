@extends('layouts.app')

@section('content')


    <h1>Edit Supplier: {!! $supplier->name !!}</h1>
    <hr>


    {!! Form::model($supplier, ['method'=>'PATCH', 'action'=>['SupplierController@update',$supplier->id]]) !!}
    @include ('suppliers.form', ['submitButtonText'=>'Update Supplier', 'editFlag' =>'true'])
    {!! Form::close() !!}

    @include ('errors.list')



@stop

@extends('layouts.app')

@section('content')


    <h1>Edit Equipment: {!! $equipment->name !!}</h1>
    <hr>


    {!! Form::model($equipment, ['method'=>'PATCH', 'action'=>['EquipmentController@update',$equipment->id]]) !!}
    @include ('equipment.form', ['submitButtonText'=>'Update Equipment', 'editFlag' =>'true'])
    {!! Form::close() !!}

    @include ('errors.list')



@stop

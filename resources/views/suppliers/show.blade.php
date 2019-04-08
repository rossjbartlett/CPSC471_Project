@extends('layouts.app')

@section('content')

    <h1> {{$supplier->name}}</h1>
    <hr>
    <h2> ID: {{$supplier->id}}</h2>
    <h2> Email: {{$supplier->email}}</h2>
    <h2> Phone Number: {{$supplier->phone}}</h2>
    <h2> Address: {{$supplier->address}}</h2>
    <h2> Contact Name: {{$supplier->contactName}}</h2>


    @if(Auth::check() && Auth::user()->isManager())
        <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
            <!--  DELETE BUTTON   -->
            {!! Form::model($supplier, ['method'=>'DELETE', 'action'=>['SupplierController@destroy',$supplier->id]]) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) !!}
            {!! Form::close() !!}
        </div>
        <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
            <!-- EDIT BUTTON   -->
            {!! Form::model($supplier, ['method'=>'GET', 'action'=>['SupplierController@edit',$supplier->id]]) !!}
            {!! Form::submit('Edit', ['class' => 'btn btn-outline-danger btn-sm']) !!}
            {!! Form::close() !!}
        </div>
    @endif


    <br>
    <hr>

    <!--  Show the supplier's equipment -->
    @if(sizeof($equipment)>0)
        <h4> Equipment: </h4>

        <div style="margin-left: 50px; font-size: 20px">
            @foreach($equipment as $e)
                -<a href="{{action('EquipmentController@show',[$e->id])}}">
                    {{$e->name}}
                </a><br>
            @endforeach
        </div>
    @else
        <p> This supplier has no equipment. </p>
    @endif

@stop

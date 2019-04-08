@extends('layouts.app')

@section('content')

    <h1> {{$equipment->name}}</h1>
    <hr>
    <h2> ID: {{$equipment->id}}</h2>
    <h2> Cost: ${{$equipment->cost}}</h2>
    <h2> Maintenance Frequency: {{$equipment->maintenanceFreq}}</h2>
    @if($equipment->lastMaintenance)
    <h2> Last Maintenance: {{$equipment->lastMaintenance}}</h2>
    @else
    <h2> This equipment has never been maintained. </h2>
    @endif

    @if(Auth::check() && Auth::user()->isManager())
        <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
            <!--  DELETE BUTTON   -->
            {!! Form::model($equipment, ['method'=>'DELETE', 'action'=>['EquipmentController@destroy',$equipment->id]]) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) !!}
            {!! Form::close() !!}
        </div>
        <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
            <!-- EDIT BUTTON   -->
            {!! Form::model($equipment, ['method'=>'GET', 'action'=>['EquipmentController@edit',$equipment->id]]) !!}
            {!! Form::submit('Edit', ['class' => 'btn btn-outline-danger btn-sm']) !!}
            {!! Form::close() !!}
        </div>
    @endif

    <br>
    <hr>

    @if(Auth::check() && Auth::user()->isManager())
        <!--  Show the equipment's supplier -->
        @if($supplier)
            <h4> Supplier:

            <a href="{{action('SupplierController@show',[$supplier->id])}}">
                {{$supplier->name}}
            </a><br></h4>
        @else
            <p> This equipment has no supplier. </p>
        @endif
    @else
        @if($supplier)
            <h4> Supplier: {{$supplier->name}}</h4>

        @else
            <p> This equipment has no supplier. </p>
        @endif
    @endif

    <br>
    <hr>

    @if(Auth::check() && Auth::user()->isManager())
        <!--  Show the current user renting the equipment -->
        @if($renter)
            <h4> Current User:
            <a href="{{action('UserController@show',[$renter->id])}}">
                {{$renter->fName}} {{$renter->lName}}
            </a><br></h4>
        @else
            <p> This equipment is currently not rented by any users. </p>
        @endif
    @else
        @if($renter)
            <p> This equipment is currently being rented. </p>
        @else
            <p> This equipment is currently not rented by any users. </p>
        @endif
    @endif

@stop

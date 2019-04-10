@extends('layouts.app')

@section('content')

    <h1>Budget Item: {{$budgetItem->name}}</h1>
    <hr>

    <h2> ID: {{$budgetItem->id}}</h2>
    <h2>Project: <a href="{{action('ProjectController@show',[$project->id])}}">
            {{$project->name}}</a><br></h2>
         
    <h2>Value: ${{$budgetItem->value}}</h2>
    <hr>
    <h2>Description:</h2> {{$budgetItem->description}}

@stop

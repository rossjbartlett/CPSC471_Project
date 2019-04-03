@extends('layouts.app')

@section('content')


    <h1>Edit Project: {!! $project->name !!}</h1>
    <hr>


    {!! Form::model($project, ['method'=>'PATCH', 'action'=>['ProjectController@update',$project->id]]) !!}
    @include ('projects.form', ['submitButtonText'=>'Update Project', 'editFlag' =>'true'])
    {!! Form::close() !!}

    @include ('errors.list')



@stop

@extends('layouts.app')

@section('content')

<h1> {{$user->email}}</h1>
<hr>

<h4> isManager: {{$user->isManager}}</h4>

<div style="padding-right: 80px;float: right;">

    {!! Form::open(['method' => 'Get', 'route' => ['users.edit', $user->id]]) !!}
    <div class="form-group" style="padding-top: 5px">
        {!! Form::submit('Edit User', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    {!! Form::close() !!}
</div>

<h4> Name: {{$user->fName}} {{$user->lName}}</h4>
<h4> Department: {{$user->deptID}} </h4>


<!--  Show the users projects -->
@if(sizeof($current_projects)>0)
<h4> Project(s): <h4>
  <div style="margin-left: 50px; font-size: 20px">
    @foreach($current_projects as $proj)
        -<a href="{{action('ProjectController@show',[$proj->id])}}">
          {{$proj->name}}
        </a><br>
    @endforeach
  </div>
@else
<p> This employee has no current projects.<p>
@endif

@stop 
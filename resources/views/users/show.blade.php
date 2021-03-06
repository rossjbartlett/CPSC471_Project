@extends('layouts.app')

@section('content')

<h1>{{$user->fName}} {{$user->lName}}</h1>

<hr>

<!-- EDIT BUTTON  -->
<!-- <div style="padding-right: 80px;float: right;">
    {!! Form::open(['method' => 'Get', 'route' => ['users.edit', $user->id]]) !!}
    <div class="form-group" style="padding-top: 5px">
        {!! Form::submit('Edit User', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    {!! Form::close() !!}
</div> -->

<h4> Email: {{$user->email}}</h4>
<h4> SIN: {{$user->SIN}}</h4>
<h4> DOB: {{$user->DOB}}</h4>
<h4> Department: 
    @if($user->department() != null) 
        <a href="{{action('DepartmentController@show',[$user->deptID])}}">{{$user->department()->name}}</a>
        @if($user->deptStartDate!=null && $user->deptStartDate!='')
          since {{$user->deptStartDate}}
        @endif
    @else 
        None
    @endif
</h4>
<h4>Phone number(s):
<div style="margin-left: 50px; font-size: 20px">
    @foreach($phone_numbers as $pn)
        -{{$pn->phone}}<br>
    @endforeach
</div>
</h4>

<hr>

@if($user->isManager)
<h5>{{$user->fName}} is a Manager.</h5>
<h4> Managed Department(s): <h4>
  <div style="margin-left: 50px; font-size: 20px">
    @foreach($user->managedDepartments() as $d)
        -<a href="{{action('DepartmentController@show',[$d->id])}}">
          {{$d->name}}
        </a><br>
    @endforeach
  </div>
 @else 
 <h5>{{$user->fName}} is not a Manager.</h5>
@endif
<hr>

@if($supervisorID!=null)
<h4> Supervisor: <a href="{{action('UserController@show',[$supervisorID])}}">
          {{$user->supervisor()->fName}} {{$user->supervisor()->lName}}
        </a><h4>
 @else 
 <h5>{{$user->fName}} has no Supervisor.</h5>
@endif

<hr>

@if($user->isSupervisor())
<h5>{{$user->fName}} is a Supervisor.</h5>
<h4> Supervisees: <h4>
  <div style="margin-left: 50px; font-size: 20px">
    @foreach($user->supervisees() as $s)
        -<a href="{{action('UserController@show',[$s->id])}}">
          {{$s->fName}} {{$s->lName}}
        </a><br>
    @endforeach
  </div>
 @else 
 <h5>{{$user->fName}} is not a Supervisor.</h5>
@endif

<hr>
<!--  Show the users projects and hours -->
@if(sizeof($projects_hours)>0)
<h4> Project(s): <h4>
  <div style="margin-left: 50px; font-size: 20px">
    @foreach($projects_hours as $ph)
        -<a href="{{action('ProjectController@show',[$ph['project']['id']])}}">{{$ph['project']['name']}}</a>, {{$ph['hours']}}h
        <br>
    @endforeach
  </div>
@else
<p> This employee has no current projects.<p>
@endif

@stop 
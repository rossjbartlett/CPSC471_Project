@extends('layouts.app')

@section('content')

    <h1>Project: {{$project->name}} </h1>
    <hr>


    @if(Auth::user()->isManager())
      <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
          <!--  DELETE BUTTON   -->
          {!! Form::model($project, ['method'=>'DELETE', 'action'=>['ProjectController@destroy',$project->id]]) !!}
          {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) !!}
          {!! Form::close() !!}
          </div>
      <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
          <!-- EDIT BUTTON   -->
          {!! Form::model($project, ['method'=>'GET', 'action'=>['ProjectController@edit',$project->id]]) !!}
          {!! Form::submit('Edit', ['class' => 'btn btn-outline-danger btn-sm']) !!}
          {!! Form::close() !!}
      </div>
    @endif


    <h2> ID: {{$project->id}}</h2>
    <h4> Controlling Department: <a href="{{action('DepartmentController@show',[$project->deptID])}}">
            {{$project->department()->name}}</a>
        </h4> 
    <h4> Budget: ${{$project->budget}}</h4>

    <br>
    <hr>

    <!--  Show the  employees working on it -->
    @if(sizeof($employees_hours)>0)
    <h4> Employees: <h4>
      <div style="margin-left: 50px; font-size: 20px">
        @foreach($employees_hours as $eh)
            -<a href="{{action('UserController@show', [$eh['employee']['id']] )}}">
              {{$eh['employee']['fName']}} {{$eh['employee']['lName']}}
            </a>, {{$eh['hours']}}h<br>
        @endforeach
      </div>
    @else
      <p> This project has no employees working on it.<p>
    @endif

    <hr>
    <!--  Show the  budget Items of the project -->
    @if(sizeof($budgetItems)>0)
    <h4> Budget Items: <h4>
      <div style="margin-left: 50px; font-size: 20px">
        @foreach($budgetItems as $b)
            -<a href="{{action('UserController@show',[$b->id])}}">
              {{$b->name}}, ${{$b->value}}
            </a><br>
        @endforeach
      </div>
    @else
      <p> This project has no budget items.<p>
    @endif



@stop

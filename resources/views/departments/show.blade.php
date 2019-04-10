@extends('layouts.app')

@section('content')

    <h1> {{$department->name}} Department</h1>
    <hr>
        <h2> ID: {{$department->id}}</h2>

        @if($department->hasManager())
          <h4> Manager: <a href="{{action('UserController@show',[$department->manager()->id])}}">
                  {{$department->manager()->fName}} {{$department->manager()->lName}}</a>
          </h4>
          <h4> Manager Start Date: {{$department->managerStartDate}}</h4>
        @else
          This department has no manager.
        @endif

        <!-- These are hidden now. dont need -->
          @if(Auth::check() && Auth::user()->isManager())
              <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
                  <!--  DELETE BUTTON   -->
                  {!! Form::model($department, ['method'=>'DELETE', 'action'=>['DepartmentController@destroy',$department->id]]) !!}
                  <!-- {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) !!} -->
                  {!! Form::close() !!}
                </div>
              <div class="btn-group-vertical" style="float:right;font-size:15px;padding:5px">
                  <!-- EDIT BUTTON   -->
                  {!! Form::model($department, ['method'=>'GET', 'action'=>['DepartmentController@edit',$department->id]]) !!}
                  <!-- {!! Form::submit('Edit', ['class' => 'btn btn-outline-danger btn-sm']) !!} -->
                  {!! Form::close() !!}
              </div>
          @endif


        <br>
        <hr>

        <!--  Show the depts employees -->
        @if(sizeof($employees)>0)
        <h4> This department has {{sizeof($employees)}} employee(s):</h4>
          <div style="margin-left: 50px; font-size: 20px">
            @foreach($employees as $e)
                -<a href="{{action('UserController@show',[$e->id])}}">
                  {{$e->fName}} {{$e->lName}}
                </a><br>
            @endforeach
          </div>
        @else
          <p> This department has no employees.<p>
        @endif
        
        <hr>

    <!--  Show the depts projects -->
    @if(sizeof($projects)>0)
    <h4> Projects: </h4>
      <div style="margin-left: 50px; font-size: 20px">
        @foreach($projects as $proj)
            -<a href="{{action('ProjectController@show',[$proj->id])}}">
              {{$proj->name}}
            </a><br>
        @endforeach
      </div>
    @else
     <p> This department has no current projects.</p>
    @endif



@stop

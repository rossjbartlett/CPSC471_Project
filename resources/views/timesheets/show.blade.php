@extends('layouts.app')

@section('content')

    <h1> {{$timesheet->user()->fName}}'s Timesheet, {{sprintf('%02d', $timesheet->month)}}/{{$timesheet->year}} </h1>
    <hr>

    <!--  Show the timesheet shifts -->
    @if(sizeof($shifts)>0)
    <h4> Shifts: <h4>
      <div style="margin-left: 50px; font-size: 20px">
        @foreach($shifts as $shift)
            -<a href="{{action('ShiftController@show',[$shift])}}">
              {{sprintf('%02d', $shift->day)}}/{{sprintf('%02d', $shift->month)}}/{{$shift->year}}
            </a><br>
        @endforeach
      </div>
    @else
     <p> This timesheet has no shifts.<p>
    @endif



@stop

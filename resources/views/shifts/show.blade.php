@extends('layouts.app')

@section('content')

    <h1>{{$shift->user()->fName}}'s Shift, {{sprintf('%02d', $shift->day)}}/{{sprintf('%02d', $shift->month)}}/{{$shift->year}}</h1>
    <hr>
    <h2>Start Time: {{$startTime}}</h2>
    <h2>End Time: {{$endTime}}</h2>


@stop

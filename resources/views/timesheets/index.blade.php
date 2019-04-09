@extends('layouts.app')

@section('content')

<header>
    <h1 style="display: inline-block;">Timesheets</h1>
    @if(Auth::check())
         <a href="{{action('ShiftController@create')}}">
            <button type="button" class="btn btn-primary" style="float:right"> Add a Shift </button>
        </a> 
    @endif
</header>
<hr>

@if(Auth()->User()->isManager())
    
    @foreach($users as $user)
        <a href="{{action('UserController@show',[$user->id])}}">
            <h2>{{$user->fName}} {{$user->lName}}</h2>
         </a><br>
        @foreach($user->timesheets() as $ts)
            <div class="col-md-12">
                <h4>
                    <a href="{{action('TimesheetController@show',[$ts])}}">
                        -{{sprintf('%02d', $ts->month)}}/{{$ts->year}}
                    </a>
                </h4>
            </div>
        @endforeach
        <hr>
    @endforeach

@else

@foreach($timesheets as $ts)


<div class="row">
    <!-- bootstrap class="row" divides the page in 12 columns. we decide how wide each of the following elements should be with class="col-md-X"-->
    <div class="col-md-12">
        <h2>
            <a href="{{action('TimesheetController@show',[$ts])}}">
                {{sprintf('%02d', $ts->month)}}/{{$ts->year}}
            </a>
        </h2>
    </div>
</div>


<hr>
@endforeach

@endif
@stop

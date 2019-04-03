@extends('layouts.app')

@section('content')

<header>
    <h1 style="display: inline-block;">Departments</h1>
    @if(Auth::check())

    <!-- TODO we can take out the create a department part. -->
        @if(Auth::user()->isManager())
            <!-- <a href="{{action('BookController@create')}}">
                <button type="button" class="btn btn-primary" style="float:right"> Create a Department </button>
            </a> -->
        @endif
    @endif        
</header>
<hr>

<!-- show messages like: Department sucessfully deleted -->
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif




@foreach($departments as $dept)


<div class="row">
    <!-- bootstrap class="row" divides the page in 12 columns. we decide how wide each of the following elements should be with class="col-md-X"-->
    <div class="col-md-12">
        <h2>
            <a href="{{action('DepartmentController@show',[$dept->id])}}">
                {{$dept->name}}
            </a>
        </h2>
    </div>
</div>


<hr>
@endforeach

@stop

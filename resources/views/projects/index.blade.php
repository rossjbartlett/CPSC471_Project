@extends('layouts.app')

@section('content')

<header>
    <h1 style="display: inline-block;">Projects</h1>
    @if(Auth::check())

        @if(Auth::user()->isManager())
            <a href="{{action('ProjectController@create')}}">
                <button type="button" class="btn btn-primary" style="float:right"> Create a Project </button>
            </a>
        @endif
    @endif        
</header>
<hr>

<!-- show messages like: Project sucessfully deleted -->
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif




@foreach($projects as $proj)


<div class="row">
    <!-- bootstrap class="row" divides the page in 12 columns. we decide how wide each of the following elements should be with class="col-md-X"-->
    <div class="col-md-12">
        <h2>
            <a href="{{action('ProjectController@show',[$proj->id])}}">
                {{$proj->name}}
            </a>
        </h2>
    </div>
</div>


<hr>
@endforeach

@stop

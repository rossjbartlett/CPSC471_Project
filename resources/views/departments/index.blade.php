@extends('layouts.app')

@section('content')

<h1>Departments</h1>  
<hr>


@foreach($departments as $dept)

<div class="row">
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

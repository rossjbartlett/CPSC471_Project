@extends('layouts.app')

@section('content')

    <header>

        @if(Auth::check())
            @if(Auth::user()->isManager())
                <h1 style="display: inline-block;">Equipment</h1>
                <a href="{{action('EquipmentController@create')}}">
                    <button type="button" class="btn btn-primary" style="float:right"> Create an Equipment </button>
                </a>
            @else
                <h1 style="display: inline-block;">Available Equipment</h1>
                @if(sizeof($equipment) == 0)
                    <p>There is currently no available equipment.</p>
                @endif
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


    @foreach($equipment as $e)

        <div class="row">
            <!-- bootstrap class="row" divides the page in 12 columns. we decide how wide each of the following elements should be with class="col-md-X"-->
            <div class="col-md-12">
                <h2>
                    <a href="{{action('EquipmentController@show',[$e->id])}}">
                        {{$e->name}}
                    </a>
                </h2>
            </div>
        </div>


        <hr>
    @endforeach


    @if(!Auth::user()->isManager() && sizeof($currently_renting) > 0)
        <h1 style="display: inline-block;">Currently Renting</h1>
        <hr>

        @foreach($currently_renting as $ce)


            <div class="row">
                <!-- bootstrap class="row" divides the page in 12 columns. we decide how wide each of the following elements should be with class="col-md-X"-->
                <div class="col-md-12">
                    <h2>
                        <a href="{{action('EquipmentController@show',[$ce->id])}}">
                            {{$ce->name}}
                        </a>
                    </h2>
                </div>
            </div>

            <hr>
        @endforeach
    @endif

@stop
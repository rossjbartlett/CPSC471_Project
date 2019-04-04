@extends('layouts.app')

<head>

    <!-- TODO: make a global stylesheet?  -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <style>
        .content{
            /* background-color: #fff; */
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 78;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            color: #636b6f;

            margin-bottom: 30px;
        }
    </style>
</head>


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in.<br>
                    Welcome, {{Auth::user()->fName}} {{Auth::user()->lName}}!<br>
                    Your ID on this system is {{Auth()->user()->id}}.<br>

                    @if (Auth()->user()->isManager())
                        <span style="color:blue">You are a manager.</span>
                    @endif

                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="title m-b-md">
            Company Management System
        </div>

        <div class="links">
        @if(Auth()->user()->isManager())                
                <a href="/projects">Projects</a>    
                <a href="/departments">Departments</a>
                <a href="/users">Employees</a>
        @else
                <a href="/projects">Your Projects</a>
                <a href="{{action('DepartmentController@show',[Auth()->User()->deptID])}}">Your Department</a>
                <!-- <a href="/users">Employees</a> -->
         @endif

        </div>
    </div>

</div>
@endsection

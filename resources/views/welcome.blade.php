@extends('master')
@section('content')
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="hover-link" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="hover-link" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="hover-link" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Company Management System
                </div>
                @if (Auth::check())
                    Welcome! You are already logged in.
                @else
                    Welcome! Please log in.
                @endif
            </div>
        </div>
@stop
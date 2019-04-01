@extends('layouts.app')

@section('content')

<h1> {{$user->email}}</h1>
<hr>

<h4> Role: {{$user->role}}</h4>

<div style="padding-right: 80px;float: right;">

    {!! Form::open(['method' => 'Get', 'route' => ['users.edit', $user->id]]) !!}
    <div class="form-group" style="padding-top: 5px">
        {!! Form::submit('Edit User', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
    {!! Form::close() !!}
</div>

<h4> Birthday: {{$user->birthday}} </h4>
<h4> Education Field: {{$user->education_field}} </h4>

<!--  Show the users subscriptions -->
@if(sizeof($current_subscribed_books)>0)
<h4> Subscription(s): <h4>
  <div style="margin-left: 50px; font-size: 20px">
    @foreach($current_subscribed_books as $book)
      @if($user->isCurrentSubscriber($book->id))
        {{$book->name}}
      @endif
      <br>
    @endforeach
  </div>
@else
<p> This user is not subscribed to any books.<p>
@endif

@stop 
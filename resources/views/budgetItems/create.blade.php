@extends('layouts.app')

@section('content')


    <h1>Add New Budget Item</h1>
    <hr>

  
    {!! Form::open(['url'=>'budgetItems']) !!}
        @include ('budgetItems.form', ['submitButtonText'=>'Add BudgetItem'])
    {!! Form::close() !!}

    
    @include ('errors.list')

    
@stop

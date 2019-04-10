
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
        {!! Form::text('date', null, ['class'=>'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('value', 'Value:') !!}
        {!! Form::text('value', null, ['class'=>'form-control']) !!}
    @endif  
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
</div> 
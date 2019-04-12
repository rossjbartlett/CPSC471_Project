
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('budget', 'Budget:') !!}
    {!! Form::text('budget', null, ['class'=>'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('deptID', 'Controlling Department ID:') !!}
    {!! Form::select('deptID', $departments_names_ids, null, ['class'=>'form-control'] ) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
</div> 

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cost', 'Cost:') !!}
    {!! Form::text('cost', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('maintenanceFreq', 'Maintenance Frequency:') !!}
    {!! Form::text('maintenanceFreq', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('supplierID', 'Supplier ID:') !!}
    {!! Form::text('supplierID', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
</div> 
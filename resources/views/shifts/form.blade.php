
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', \Carbon\Carbon::now()->format('d/m/Y'), ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('startTime', 'Start Time:') !!}
    {!! Form::input('time', 'starttime', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('endTime', 'End Time:') !!}
    {!! Form::input('time', 'endtime', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class'=>'btn btn-primary form-control']) !!}
</div> 
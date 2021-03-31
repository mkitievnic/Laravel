<!-- Fecha Inicial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_inicial', 'Fecha Inicial: *') !!}
    {!! Form::text('fecha_inicial', isset($examen) ? date('d/m/Y', strtotime($examen->fecha_inicial)) : date("d/m/Y"), ['class' => 'form-control datepicker', 'required']) !!}
</div>

<!-- Fecha Final Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_final', 'Fecha Final: *') !!}
    {!! Form::text('fecha_final', isset($examen) ?  date('d/m/Y', strtotime($examen->fecha_final)) : date("d/m/Y"), ['class' => 'form-control datepicker', 'required']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12">
    {!! Form::label('descripcion', 'Descripción: *') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'250']) !!}
</div>

<!-- Tiempo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tiempo', 'Tiempo [minutos]: *') !!}
    {!! Form::number('tiempo', isset($examen) ? null : 30, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado: *') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('estado', 0) !!}
        {!! Form::checkbox('estado', '1', null) !!}
    </label>
</div>

{!! Form::hidden('evento_id', $evento->id, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>

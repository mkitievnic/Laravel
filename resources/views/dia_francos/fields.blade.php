<!-- Fecha desde Field -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_inicio', 'Desde: *') !!}
    {!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker', 'required', "autocomplete"=>"off"]) !!}
</div>

<!-- Fecha hasta Field -->
<div class="form-group col-sm-4">
    {!! Form::label('fecha_final', 'Hasta:*') !!}
    {!! Form::text('fecha_final', null, ['class' => 'form-control datepicker', 'required', "autocomplete"=>"off"]) !!}
</div>

{!! Form::hidden('empleado_id', $empleado->id, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-sm-4" style="padding-top: 25px">
    {!! Form::submit('Asignar', ['class' => 'btn btn-success btn-block']) !!}
</div>

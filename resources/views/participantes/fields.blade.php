{!! Form::hidden('gestion', date('Y', strtotime($evento->fecha_inicial)), ['class' => 'form-control']) !!}
{!! Form::hidden('evento_id', $evento->id, ['class' => 'form-control']) !!}



<!-- Empleado Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('empleado_id', 'Empleado: *') !!}
    {!! Form::select('empleado_id', \App\Patrones\Fachada::getEmpleadosDisponibles($evento->id), null, ['class' => 'form-control select2', 'required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Agregar participante', ['class' => 'btn btn-primary', 'onclick' => "return confirm('¿Seguro que quieres agregar a este participante?')"]) !!}
    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
</div>

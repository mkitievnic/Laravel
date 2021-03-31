<!-- Pregunta Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pregunta', 'Pregunta: *') !!}
    {!! Form::text('pregunta', null, ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'150']) !!}
</div>

<!-- Respuesta Field -->
<div class="form-group col-sm-12">
    {!! Form::label('respuesta', 'Respuesta: *') !!}
    {!! Form::textarea('respuesta', null, ['class' => 'form-control', 'required', 'minlength'=>'5']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('preguntaFrecuentes.index') }}" class="btn btn-default">Cancelar</a>
</div>

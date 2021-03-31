<!-- Pregunta Field -->
<div class="form-group">
    {!! Form::label('pregunta', 'Pregunta:') !!}
    <p>{{ $preguntaFrecuente->pregunta }}</p>
</div>

<!-- Respuesta Field -->
<div class="form-group">
    {!! Form::label('respuesta', 'Respuesta:') !!}
    <p>{{ $preguntaFrecuente->respuesta }}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{{ $preguntaFrecuente->usuario_id }}</p>
</div>


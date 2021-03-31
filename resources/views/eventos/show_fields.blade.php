<!-- Fecha Inicial Field -->
<div class="form-group">
    {!! Form::label('fecha_inicial', 'Fecha Inicial:') !!}
    <p>{{ $evento->fecha_inicial }}</p>
</div>

<!-- Fecha Final Field -->
<div class="form-group">
    {!! Form::label('fecha_final', 'Fecha Final:') !!}
    <p>{{ $evento->fecha_final }}</p>
</div>

<!-- Hora Inicial Field -->
<div class="form-group">
    {!! Form::label('hora_inicial', 'Hora Inicial:') !!}
    <p>{{ $evento->hora_inicial }}</p>
</div>

<!-- Hora Final Field -->
<div class="form-group">
    {!! Form::label('hora_final', 'Hora Final:') !!}
    <p>{{ $evento->hora_final }}</p>
</div>

<!-- Direccion Field -->
<div class="form-group">
    {!! Form::label('direccion', 'Direccion:') !!}
    <p>{{ $evento->direccion }}</p>
</div>

<!-- Esta Abierto Field -->
<div class="form-group">
    {!! Form::label('esta_abierto', 'Esta Abierto:') !!}
    <p>{{ $evento->esta_abierto }}</p>
</div>

<!-- Curso Funcion Id Field -->
<div class="form-group">
    {!! Form::label('curso_funcion_id', 'Curso Funcion Id:') !!}
    <p>{{ $evento->curso_funcion_id }}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{{ $evento->usuario_id }}</p>
</div>


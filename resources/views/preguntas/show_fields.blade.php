<!-- Pregunta Field -->
<div class="form-group">
    {!! Form::label('pregunta', 'Pregunta:') !!}
    <p>{!! $pregunta->pregunta !!}</p>
</div>

<!-- Url Imagen Field -->
<div class="form-group">
    {!! Form::label('url_imagen', 'Url Imagen:') !!}
    <p>{{ $pregunta->url_imagen }}</p>
</div>

<!-- Curso Id Field -->
<div class="form-group">
    {!! Form::label('curso_id', 'Curso Id:') !!}
    <p>{{ $pregunta->curso_id }}</p>
</div>


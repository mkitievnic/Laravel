<!-- Codigo Field -->
<div class="form-group col-sm-2">
    {!! Form::label('codigo', 'Código: *') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control', 'required', 'minlength'=>'4', 'maxlength'=>'8']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre: *') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'minlength'=>'3', 'maxlength'=>'150']) !!}
</div>

<!-- Duracion Field -->
<div class="form-group col-sm-2">
    {!! Form::label('duracion', 'Duración: (horas) *') !!}
    {!! Form::number('duracion', null, ['class' => 'form-control', 'min' => '1']) !!}
</div>

<!-- Duracion Field -->
<div class="form-group col-sm-2">
    {!! Form::label('vencimiento', 'Vencimiento: (años) *') !!}
    {!! Form::number('vencimiento', null, ['class' => 'form-control', 'min' => '1']) !!}
</div>

<!-- Contenido Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('contenido', 'Contenido: *') !!}
    {!! Form::textarea('contenido', null, ['class' => 'form-control summernote', 'minlength'=>'10']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('estado', 'Estado: *') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('estado', 0) !!}
        {!! Form::checkbox('estado', '1', null) !!}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cursos.index') }}" class="btn btn-default">Cancelar</a>
</div>

<!-- Pregunta Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('pregunta', 'Descripción de la pregunta: *') !!}
    {!! Form::textarea('pregunta', null, ['class' => 'form-control summernotepregunta', 'required']) !!}
</div>

@if(isset($pregunta))
    <div class="form-group col-sm-12">
        {!! Form::label('estado', 'Estado: *') !!}
        <label class="checkbox-inline">
            {!! Form::hidden('estado', 0) !!}
            {!! Form::checkbox('estado', '1', null) !!}
        </label>
    </div>
@endif

{!! Form::hidden('curso_id', $curso->id, ['class' => 'form-control']) !!}

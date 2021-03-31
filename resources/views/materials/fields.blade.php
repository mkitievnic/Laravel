<!-- Descripcion Field -->
<div class="form-group col-sm-12">
    {!! Form::label('descripcion', 'Descripción: *') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'required', 'minlength' => '10', 'maxlength'=>'250']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-8">
    {!! Form::label('url', 'Eliga archivo: * (*.pdf, *.docx, *.png, *.jpg)') !!}
    <input type="file" name="url" id="url"  accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" />
</div>

{!! Form::hidden('curso_id', $curso->id, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-sm-4 text-right" style="margin-top: 25px">
    {!! Form::submit('Subir material', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cursos.index') }}" class="btn btn-default">Volver</a>
</div>

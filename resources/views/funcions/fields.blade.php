<!-- Sector Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sector_id', 'Sector: *') !!}
    {!! Form::select('sector_id', \App\Models\Sector::all()->pluck('nombre', 'id') ,null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nombre', 'Nombre: *') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'100']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('funcions.index') }}" class="btn btn-default">Cancelar</a>
</div>

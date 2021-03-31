<!-- Ci Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ci', 'Ci: *') !!}
    {!! Form::text('ci', null, ['class' => 'form-control', 'required', 'minlength' => '5', 'maxlength'=>'10']) !!}
</div>

<!-- Expedido Field -->
<div class="form-group col-sm-2">
    {!! Form::label('expedido', 'Expedido: *') !!}
    {!! Form::select('expedido', \App\Patrones\Fachada::getDepartamets(), null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('proveedor_id', 'Proveedor: *') !!}
    {!! Form::select('proveedor_id', \App\Models\Proveedor::where('id', '<>', '1')->get()->pluck('nombre', 'id'), null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre: *') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'minlength' => '3', 'maxlength'=>'20']) !!}
</div>

<!-- Apellido Paterno Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apellido_paterno', 'Apellido Paterno: *') !!}
    {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'required', 'minlength' => '5', 'maxlength'=>'20']) !!}
</div>

<!-- Apellido Materno Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apellido_materno', 'Apellido Materno:') !!}
    {!! Form::text('apellido_materno', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-3">
    {!! Form::label('email', 'Email: *') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Telefono o celular Field -->
<div class="form-group col-sm-3">
    {!! Form::label('telefono', 'Telefono o celular: *') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control', 'required', 'minlength' => '5', 'maxlength'=>'20']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('instructors.index') }}" class="btn btn-default">Cancelar</a>
</div>

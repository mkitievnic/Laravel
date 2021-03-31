<div class="col-sm-9">
    <!-- Legajo Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('legajo', 'Legajo: *') !!}
        {!! Form::number('legajo', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Ci Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('ci', 'Ci: *') !!}
        {!! Form::text('ci', null, ['class' => 'form-control', 'required', 'maxlength'=>10, 'minlength' => 5]) !!}
    </div>

    <!-- Expedido Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('expedido', 'Expedido: *') !!}
        {!! Form::select('expedido', \App\Patrones\Fachada::getDepartamets(), null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Nombre Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('nombre', 'Nombre: *') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'maxlength'=>20, 'minlength' => 3]) !!}
    </div>

    <!-- Apellido Paterno Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('apellido_paterno', 'Apellido Paterno: *') !!}
        {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'required', 'maxlength'=>15, 'minlength' => 2]) !!}
    </div>

    <!-- Apellido Materno Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('apellido_materno', 'Apellido Materno: *') !!}
        {!! Form::text('apellido_materno', null, ['class' => 'form-control', 'maxlength'=>15]) !!}
    </div>

    <!-- Fecha Nacimiento Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento: *') !!}
        {!! Form::text('fecha_nacimiento', isset($empleado) ? date('d/m/Y', strtotime($empleado->fecha_nacimiento)) : null, ['class' => 'form-control datepicker', 'required', "autocomplete"=>"off"]) !!}
    </div>

    <!-- Emai Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('email', 'Email: *') !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Fecha Nacimiento Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('telefono', 'Telefono: *') !!}
        {!! Form::text('telefono', null, ['class' => 'form-control', 'required', 'minlength' => '5', 'maxlength'=>'20']) !!}
    </div>

    <div class="form-group col-sm-12">
        <hr>
        {!! Form::label('proveedor_id', 'Proveedor: *') !!}
        {!! Form::select('proveedor_id', \App\Models\Proveedor::get()->pluck('nombre', 'id'), null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="form-group col-sm-12">
        {!! Form::label('funcion_id', 'Función: *') !!}
        {!! Form::select('funcion_id', \App\Models\Funcion::get()->pluck('informacion', 'id'), null, ['class' => 'form-control select2', 'required']) !!}
    </div>
</div>

<div class="col-sm-3">

<!-- Foto Field -->
    <div class="thumbnail">
        @if(isset($empleado) && isset($empleado->foto) && $empleado->foto !== "")
            <img id="img_destino" src="{{ asset('/user_photos/'.$empleado->foto) }}" alt="foto">
        @else
            <img id="img_destino" src="{{ asset('/user_photos/foto_base.png') }}" alt="foto">
        @endif

        <div class="caption text-center">
            <div class="foto_boton file btn btn-lg btn-primary">
                <i class="glyphicon glyphicon-paperclip"></i> Cargar Fotografía
                <input id="foto_input" class="foto_input" type="file" name="foto_input" accept="image/*"/>
            </div>
        </div>
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('empleados.index') }}" class="btn btn-default">Cancelar</a>
</div>

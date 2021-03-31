<div class="row">
    <div class="col-sm-6">
        <!-- Foto Field -->
        <div class="form-group text-center">
            @if(isset($empleado) && isset($empleado->foto) && $empleado->foto !== '')
                <img style="max-width: 300px" id="img_destino" src="{{ asset('/user_photos/'.$empleado->foto) }}" alt="foto">
            @else
                <img id="img_destino" src="{{ asset('/user_photos/foto_base.png') }}" alt="foto">
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <!-- Legajo Field -->
        <div class="form-group">
            {!! Form::label('legajo', 'Legajo:') !!}
            <p>{{ $empleado->legajo }}</p>
        </div>

        <!-- Ci Field -->
        <div class="form-group">
            {!! Form::label('ci', 'Ci:') !!}
            <p>{{ $empleado->ci }}</p>
        </div>

        <!-- Expedido Field -->
        <div class="form-group">
            {!! Form::label('expedido', 'Expedido:') !!}
            <p>{{ $empleado->expedido }}</p>
        </div>

        <!-- Nombre Field -->
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre:') !!}
            <p>{{ $empleado->nombre }}</p>
        </div>

        <!-- Apellido Paterno Field -->
        <div class="form-group">
            {!! Form::label('apellido_paterno', 'Apellido Paterno:') !!}
            <p>{{ $empleado->apellido_paterno }}</p>
        </div>

        <!-- Apellido Materno Field -->
        <div class="form-group">
            {!! Form::label('apellido_materno', 'Apellido Materno:') !!}
            <p>{{ $empleado->apellido_materno }}</p>
        </div>

        <!-- Fecha Nacimiento Field -->
        <div class="form-group">
            {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento:') !!}
            <p>{{ $empleado->fecha_nacimiento }}</p>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('telefono', 'Email:') !!}
            <p>{{ $empleado->email }}</p>
        </div>

        <!-- Celular Field -->
        <div class="form-group">
            {!! Form::label('telefono', 'Telefono:') !!}
            <p>{{ $empleado->telefono }}</p>
        </div>
    </div>
</div>

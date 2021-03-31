<div class="col-sm-6">
    <!-- Sector Id Field -->
    <div class="form-group">
        {!! Form::label('sector_id', 'Sector:') !!}
        <p>{{ $funcion->sector->nombre }}</p>
    </div>
</div>

<div class="col-sm-6">
    <!-- Nombre Field -->
    <div class="form-group">
        {!! Form::label('nombre', 'Functión:') !!}
        <p>{{ $funcion->nombre }}</p>
    </div>
</div>

<div class="col-sm-12">
    <hr>
</div>

{!! Form::open(['route' => 'cursoFuncions.store']) !!}
<div class="form-group col-sm-2">
    {!! Form::label('gestion', 'Gestión: *') !!}
    {!! Form::number('gestion', date("Y"), ['class' => 'form-control', 'required', 'min'=>'2015', 'max'=>'2050']) !!}
</div>

<div class="col-sm-8">
    <div class="form-group">
        {!! Form::label('curso_id', 'Selecciones curso: *') !!}
        {!! Form::select('curso_id', \App\Models\Curso::get()->pluck('informacion', 'id'), null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

{!! Form::hidden('funcion_id', $funcion->id, ['class' => 'form-control']) !!}

<div class="col-sm-2" style="margin-top: 25px">
    {!! Form::submit('Agregar curso', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


<div class="col-sm-12">
   @include('curso_funciones.table')
</div>

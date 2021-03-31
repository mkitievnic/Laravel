<div class="form-group col-sm-12">
    {!! Form::label('curso_id', 'Seleccione curso:') !!}
    {!! Form::select('curso_id', [null => 'Todos'] + \App\Models\Curso::whereEstado(true)->get()->pluck('nombre', 'id')->toArray(), isset($_GET['curso_id']) ? $_GET['curso_id'] : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-5">
    {!! Form::label('fecha_inicial', 'Fecha inicial: *') !!}
    {!! Form::text('fecha_inicial',isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : date("d/m/Y") , ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'required']) !!}
</div>

<div class="form-group col-sm-5">
    {!! Form::label('fecha_final', 'Fecha final: *') !!}
    {!! Form::text('fecha_final',isset($_GET['fecha_final']) ? $_GET['fecha_final'] : date("d/m/Y"), ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'required']) !!}
</div>

<div class="form-group col-sm-1" style="margin-top: 25px;">
    <button type="submit" class="btn btn-default" title="Generar"><i
            class="glyphicon glyphicon-search"></i>
    </button>
</div>

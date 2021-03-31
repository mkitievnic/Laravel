<div class="form-group col-sm-5">
    {!! Form::label('curso_id', 'Seleccione curso:') !!}
    {!! Form::select('curso_id', [null => 'Todos'] + \App\Models\Curso::whereEstado(true)->get()->pluck('nombre', 'id')->toArray(), isset($_GET['curso_id']) ? $_GET['curso_id'] : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('fecha_inicial', 'Fecha inicial:') !!}
    {!! Form::date('fecha_inicial',isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : date("Y")."-01-01" , ['class' => 'form-control', 'autocomplete' => 'off']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('fecha_final', 'Fecha final:') !!}
    {!! Form::date('fecha_final',isset($_GET['fecha_final']) ? $_GET['fecha_final'] : date("Y")."-12-31", ['class' => 'form-control', 'autocomplete' => 'off']) !!}
</div>

<div class="form-group col-sm-1" style="margin-top: 25px; margin-left: -20px">
    <button type="submit" class="btn btn-default"><i
            class="glyphicon glyphicon-search"></i>
    </button>
</div>

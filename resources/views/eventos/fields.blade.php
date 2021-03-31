@php
    $col = 6;
    $colHora = 6;
    if(isset($evento)) {
        $col = 4;
        $colHora = 2;
    }
@endphp
<!-- Fecha Inicial Field -->
<div class="form-group col-sm-{{ $col }}">
    {!! Form::label('fecha_inicial', 'Fecha inicial: *') !!}
    @if(isset($evento))
        {!! Form::date('fecha_inicial', null, ['class' => 'form-control', 'v-model' => 'curso.fecha' ,'required', 'autocomplete' => 'off']) !!}
    @else
        {!! Form::text('fecha_inicial', null, ['class' => 'form-control datepickerInicial', 'v-model' => 'curso.fecha' ,'required', 'autocomplete' => 'off']) !!}
    @endif
</div>

<!-- Fecha Final Field -->
<div class="form-group col-sm-{{ $col }}">
    {!! Form::label('fecha_final', 'Fecha final: *') !!}
    @if(isset($evento))
        {!! Form::date('fecha_final', null, ['class' => 'form-control', 'v-model' => 'curso.fecha' ,'required', 'autocomplete' => 'off', 'readonly'=>$esEdit]) !!}
    @else
        {!! Form::text('fecha_final', null, ['class' => 'form-control datepickerInicial', 'v-model' => 'curso.fecha' ,'required', 'autocomplete' => 'off', 'readonly'=>$esEdit]) !!}
    @endif
</div>

<!-- Hora Inicial Field -->
<div class="form-group col-sm-{{ $colHora }}">
    {!! Form::label('hora_inicial', 'Hora desde: *') !!}
    {!! Form::time('hora_inicial', null, ['class' => 'form-control', 'required', 'readonly'=>$esEdit]) !!}
</div>

<!-- Hora Final Field -->
<div class="form-group col-sm-{{ $colHora }}">
    {!! Form::label('hora_final', 'Hora hasta: *') !!}
    {!! Form::time('hora_final', null, ['class' => 'form-control', 'required', 'readonly'=>$esEdit]) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-12">
    {!! Form::label('direccion', 'Dirección: *') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control', 'required', 'minlength' => 5, 'maxlength' => 200, 'readonly'=>$esEdit]) !!}
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('usuario_id', 'Instructor: *') !!}
    @if(!$esEdit)
        {!! Form::select('usuario_id', \App\User::whereNivel(\App\Patrones\Rol::Medio)->get()->pluck('persona.informacion', 'id'), null, ['class' => 'form-control select2', 'required']) !!}
    @else
        {!! Form::text('usuario_id', $evento->usuario->persona->nombre_completo, ['class' => 'form-control', 'required', 'readonly']) !!}
    @endif
</div>

{!! Form::hidden('curso_id', null, ['class' => 'form-control', 'required', 'v-model' => 'curso.curso.id']) !!}


{{--<div class="col-lg-12 col-xs-12">--}}
{{--    <iframe width="100%" height="300px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"--}}
{{--            src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=-18.019456,-67.027593&amp;sspn=-18.019456,-67.027593&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>--}}
{{--</div>--}}

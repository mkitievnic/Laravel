<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Cuenta: *') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'100']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password: *') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'15']) !!}
</div>

<!-- Nivel Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nivel', 'Nivel: *') !!}
    @if(isset($user->persona->tipo))
    {!! Form::select('nivel', \App\Patrones\Fachada::getRoles(), null, ['class' => 'form-control', 'disabled']) !!}
        @else
        {!! Form::select('nivel', \App\Patrones\Fachada::getRoles(), null, ['class' => 'form-control', 'required']) !!}
        @endif
</div>

<div class="form-group col-sm-12">
    {!! Form::label('alta', 'Alta: *') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('alta', 0) !!}
        {!! Form::checkbox('alta', '1', null) !!}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    @if($user->persona->esEmpleado)
        <a href="{{ route('empleados.index') }}" class="btn btn-default">Cancelar</a>
    @else
        <a href="{{ route('instructors.index') }}" class="btn btn-default">Cancelar</a>
    @endif
</div>

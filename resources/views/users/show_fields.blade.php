<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Nivel Field -->
<div class="form-group">
    {!! Form::label('nivel', 'Nivel:') !!}
    <p>{{ $user->nivel }}</p>
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{{ $user->remember_token }}</p>
</div>

<!-- Empleado Id Field -->
<div class="form-group">
    {!! Form::label('empleado_id', 'Empleado Id:') !!}
    <p>{{ $user->empleado_id }}</p>
</div>


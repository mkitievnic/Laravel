@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Mi Perfil [ {{ $empleado->usuario->email }} ]
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-9">
                        @if(\App\Patrones\Permisos::esAdministrador())
                            {!! Form::model($empleado, ['route' => ['empleados.update', $empleado->id], 'method' => 'patch', 'files'=>true]) !!}
                                @include('empleados.fields')
                            {!! Form::close() !!}
                        @else
                            @include('empleados.show')
                        @endif
                    </div>
                    <div class="col-sm-3">
                        @include('users.password_fields', ['user' => $empleado->usuario])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Empleado
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'empleados.store', 'files'=>true]) !!}

                        @include('empleados.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

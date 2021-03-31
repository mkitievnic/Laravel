@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cursos asignados a la función
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="clearfix"></div>
                @include('flash::message')
                @include('adminlte-templates::common.errors')
                <div class="clearfix"></div>

                <div class="row" style="padding-left: 20px">
                    @include('funcions.show_fields')
                    <div class="col-sm-12">
                        <a href="{{ route('funcions.index') }}" class="btn btn-default">Volver a la lista de funciones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

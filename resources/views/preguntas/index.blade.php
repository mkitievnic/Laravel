@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Banco de preguntas<br>
            <small>Curso: {{$curso->nombre}}</small>
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{{ route('preguntas.create', ['curso_id' => request()->curso_id]) }}">Agregar nueva pregunta</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::open(['url' => 'preguntas', 'method'=>'get']) !!}

                        <div class="form-group col-sm-10">
                            {!! Form::label('txtBuscar', 'Bucar por:') !!}
                            {!! Form::text('txtBuscar', isset($_GET['txtBuscar']) ? $_GET['txtBuscar']: null, ['class' => 'form-control']) !!}
                        </div>

                        <input type="hidden" value="{{ request()->curso_id }}" name="curso_id">

                        <div class="form-group col-sm-2" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                @include('preguntas.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection


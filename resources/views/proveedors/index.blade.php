@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Lista de proveedores</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{{ route('proveedors.create') }}">Agregar nuevo</a>
        </h1>
        <br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::open(['route' => 'proveedors.index', 'method'=>'get']) !!}

                        <div class="form-group col-sm-10">
                            {!! Form::label('txtBuscar', 'Bucar por:') !!}
                            {!! Form::text('txtBuscar', isset($_GET['txtBuscar']) ? $_GET['txtBuscar']: null, ['class' => 'form-control']) !!}

                        </div>

                        <div class="form-group col-sm-2" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                @include('proveedors.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection


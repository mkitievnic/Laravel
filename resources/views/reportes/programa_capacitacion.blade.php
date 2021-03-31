@extends('layouts.app')

@section('css')
    <style>
        @page {
            size: letter portrait;
        }
    </style>
@stop

@section('content')
    <section class="content-header">
        <h1 class="pull-right">
            <button class="btn btn-info pull-right" style="margin-top: -5px;margin-bottom: 5px" onclick="print()">
                Imprimir
            </button>
        </h1>
        <br>
    </section>
    <div class="content">
        @include("reportes.encabezado")

        <div class="box box-primary">
            <h1 class="text-center">PROGRAMA DE CAPACITACIÓN</h1>
            <div class="text-center">GESTIÓN: {{ $gestion }}</div>
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12 onlyview">
                        {!! Form::open(['url' => 'reportes/getProgramaCapacitacion/' . date("Y"), 'method'=>'get']) !!}
                        <div class="form-group col-sm-4">
                            {!! Form::label('txtEstado', 'Estado:') !!}
                            {!! Form::select('txtEstado', ["%" => "Todos"] + \App\Patrones\Fachada::getEstadoEventos() ,  isset($_GET['txtEstado']) ? $_GET['txtEstado'] : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-2" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Inicia</th>
                                    <th>Termina</th>
                                    <th>Curso</th>
                                    <th>Instructor</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nro = 1;
                                @endphp
                                @foreach($eventos as $evento)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ date("d/m/Y", strtotime($evento->fecha_inicial)) }}</td>
                                        <td>{{ date("d/m/Y", strtotime($evento->fecha_final)) }}</td>
                                        <td>{{ $evento->curso->nombre }}</td>
                                        <td>{{ $evento->usuario->persona->nombre_completo }}</td>
                                        <td>{{ $evento->estado }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


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
            <h1 class="text-center">HISTÓRICO DE CAPACITACIÓN</h1>
            <div class="box-body">
                <div class="row">


                    <div class="col-sm-12 onlyview">
                        {!! Form::open(['route' => 'reportes.getHistoricoCapacitacion', 'method'=>'get']) !!}

                        <div class="form-group col-sm-10">
                            {!! Form::label('empleado_id', 'Empleado o participante:') !!}
                            {!! Form::select('empleado_id', \App\Models\Empleado::get()->pluck('informacion','id'), isset($_GET['empleado_id']) ? $_GET['empleado_id'] : date("Y")."-01-01" , ['class' => 'form-control select2', 'autocomplete' => 'off']) !!}
                        </div>

                        <div class="form-group col-sm-1" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}

                        <hr>
                    </div>


                    <div class="col-sm-12">
                        <p>
                            Legajo: {{ $empleado->legajo }} <br>
                            Paterno: {{ $empleado->apellido_paterno }} <br>
                            Materno: {{ $empleado->apellido_materno }} <br>
                            Nombres: {{ $empleado->nombre }} <br>
                            Función: {{ $empleado->funcion->nombre }} <br>
                        </p>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Fecha Inicial</th>
                                    <th>Fecha Final</th>
                                    <th>Curso</th>
                                    <th>Aprobado</th>
                                    <th>Vencido</th>
                                    <th>Instructor</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nro = 1;
                                @endphp
                                @foreach($participantes as $participante)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ date("d/m/Y", strtotime($participante->evento->fecha_inicial)) }}</td>
                                        <td>{{ date("d/m/Y", strtotime($participante->evento->fecha_final)) }}</td>
                                        <td>{{ $participante->evento->curso->nombre }}</td>
                                        <td>{{ $participante->observacion }}</td>
                                        <td>{{ $participante->evento->estaVigente }}</td>
                                        <td>{{ $participante->evento->usuario->persona->nombre_completo }}</td>
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


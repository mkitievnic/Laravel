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
            <h1 class="text-center">Conductores Habilitados</h1>
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12 onlyview">
                        {!! Form::open(['url' => 'reportes/getConductoresHabilitados', 'method'=>'get']) !!}

                        <div class="form-group col-sm-6">
                            {!! Form::label('txtBuscar', 'Bucar por:') !!}
                            {!! Form::text('txtBuscar', isset($_GET['txtBuscar']) ? $_GET['txtBuscar']: null, ['class' => 'form-control', 'placeholder'=>'legajo, nombre']) !!}

                        </div>

                        <div class="form-group col-sm-4">
                            {!! Form::label('txtFuncion', 'Función:') !!}
                            {!! Form::select('txtFuncion', ([null => 'Todos'] +  \App\Models\Funcion::all()->pluck('nombre', 'id')->toArray()),  isset($_GET['txtFuncion']) ? $_GET['txtFuncion'] : null, ['class' => 'form-control select2']) !!}
                        </div>

                        <div class="form-group col-sm-2" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-sm-12">

                        <center>
                            <table class="onlyprint" border="1px" style="width: 300px">
                                <tr>
                                    <th colspan="2">Clasificadores</th>
                                </tr>
                                <tr>
                                    <td>Pdte</td>
                                    <td><i>Pendiente</i></td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td><i>No corresponde a su funcion</i></td>
                                </tr>
                            </table>
                        </center>
                        <small>* Solo se listan conductores que apliquen segun su función.</small>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Legajo</th>
                                    <th>Nombre completo</th>
                                    <th>Funcion</th>
                                    <th>Manejo defensivo</th>
                                    <th>Montacarga</th>
                                    <th>Grua</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nro = 1;
                                    $totalMdi = 0;
                                    $totalMon = 0;
                                    $totalGru = 0;
                                @endphp
                                @foreach($empleados as $empleado)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $empleado->legajo }}</td>
                                        <td>{{ $empleado->nombre_completo }}</td>
                                        <td>{{ $empleado->funcion->nombre }}</td>
                                        <td class="text-center">
                                            {{ $empleado->conductorHabilitado(20) }}
                                            @php
                                                if($empleado->conductorHabilitado(20) === 'Vigente')
                                                    $totalMdi++;
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $empleado->conductorHabilitado(40) }}
                                            @php
                                                if($empleado->conductorHabilitado(40) === 'Vigente')
                                                    $totalMon++;
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $empleado->conductorHabilitado(17) }}
                                            @php
                                                if($empleado->conductorHabilitado(17) === 'Vigente')
                                                    $totalGru++;
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

                <p>
                    Conductores: {{ $nro - 1 }} <br>
                    Vigente MDI: {{ $totalMdi }} <br>
                    Vigente MON-01: {{ $totalMon }} <br>
                    Vigente GRU-01: {{ $totalGru }} <br>
                </p>

            </div>

        </div>
    </div>
@endsection

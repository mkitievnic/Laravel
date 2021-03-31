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
            <h1 class="text-center">Personal Well Control</h1>
            <div class="box-body">
                <div class="row">


                    <div class="col-sm-12 onlyview">
                        {!! Form::open(['route' => 'reportes.getPersonalWellControl', 'method'=>'get']) !!}

                        <div class="form-group col-sm-3">
                            {!! Form::label('fecha_inicial', 'Fecha inicial:') !!}
                            {!! Form::date('fecha_inicial',isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : date("Y")."-01-01" , ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('fecha_final', 'Fecha final:') !!}
                            {!! Form::date('fecha_final',isset($_GET['fecha_final']) ? $_GET['fecha_final'] : date("Y")."-12-31", ['class' => 'form-control', 'autocomplete' => 'off']) !!}
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
                            <strong>Fecha inicial: </strong> {{ $fechaInicial->format("d/m/Y") }}<br>
                            <strong>Fecha final: </strong> {{ $fechaFinal->format("d/m/Y")  }}
                        </p>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Legajo</th>
                                    <th>Nombre completo</th>
                                    <th>Funcion</th>
                                    <th>Well Control</th>
                                    <th>Fecha de Emision</th>
                                    <th>Vigencia hasta</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nro = 1;
                                    $totalVigente = 0;
                                    $totalVencido = 0;
                                @endphp
                                @foreach($participantes as $participante)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $participante->empleado->legajo }}</td>
                                        <td>{{ $participante->empleado->nombre_completo }}</td>
                                        <td>{{ $participante->empleado->funcion->nombre }}</td>
                                        <td>
                                            @if($participante->evento->estaVigente === "Vigente")
                                                @php $totalVigente++; @endphp
                                                <span style="color: green">
                                                {{ $participante->evento->estaVigente  }}
                                                </span>
                                            @else
                                                @php $totalVencido++; @endphp
                                                <span style="color: green">
                                                {{ $participante->evento->estaVigente  }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ date("d/m/Y", strtotime($participante->evento->fecha_final))}}</td>
                                        <td>{{ date("d/m/Y", strtotime($participante->evento->fecha_caducidad))}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

                <p>
                    Vigente WCS: {{ $totalVigente }} <br>
                    Vencido WCS: {{ $totalVencido }} <br>
                </p>

            </div>

        </div>
    </div>
@endsection

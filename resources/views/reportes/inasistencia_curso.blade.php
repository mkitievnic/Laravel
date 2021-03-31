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
            <h1 class="text-center">INASISTENTES POR CURSO</h1>
            <div class="box-body">
                <div class="row">


                    <div class="col-sm-12 onlyview">
                        {!! Form::open(['route' => 'reportes.getInasistentesCurso', 'method'=>'get']) !!}

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
                                    <th>Fecha</th>
                                    <th>Código</th>
                                    <th>Curso</th>
                                    <th>Inasistentes</th>
                                    <th>Convocados</th>
                                    <th>% inasistentes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nro = 1;
                                    $ti = $tt = $tp = 0;
                                @endphp
                                @foreach($eventos as $evento)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ date("d/m/Y", strtotime($evento->fecha_inicial))}}
                                            - {{date("d/m/Y", strtotime( $evento->fecha_final)) }}</td>
                                        <td>{{ $evento->curso->codigo }}</td>
                                        <td>{{ $evento->curso->nombre }}</td>
                                        <td>
                                            {{ $evento->participantes->whereNull('examen')->count()  }}
                                            @php
                                                $ti += $evento->participantes->whereNull('examen')->count();
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $evento->participantes->count() }}
                                            @php
                                                $tt += $evento->participantes->count();
                                            @endphp
                                        </td>
                                        <td>
                                            @if($evento->participantes->count() > 0)
                                                {{ round( ($evento->participantes->whereNull('examen')->count()  * 100) / $evento->participantes->count() , 2) }} %
                                            @else
                                                0 %
                                            @endif

                                            @php
                                                if($evento->participantes->count() > 0)
                                                    $tp += ($evento->participantes->whereNull('examen')->count()  * 100) / $evento->participantes->count();
                                                else
                                                    $tp += 0;
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>TOTALES:</td>
                                    <td>{{ $ti }}</td>
                                    <td>{{ $tt }}</td>
                                    <td>
                                        @if(($nro-1) > 0)
                                            {{ round($tp / ($nro - 1) , 2)}} %
                                        @else
                                            0 %
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

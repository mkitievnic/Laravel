@extends('layouts.app')

@section('css')
    <style>
        @page {
            size: legal landscape;
        }

        .anchoTabla {
            width: 100%;
        }
    </style>
    <style media="print">
        .anchoTabla {
            width: 100%;
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
        @include('reportes.encabezado')
        <div class="box box-primary">
            <h1 class="text-center">CUMPLIMIENTO CAPACITACIÓN</h1>
            <div class="text-center">{{ date('Y') }}</div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped anchoTabla">
                                <thead>
                                <tr>
                                    <th>Mes</th>
                                    @foreach($cursos as $curso)
                                        <th style="height: 120px;"><p
                                                class="verticalText"> {{ $curso->codigo }}</p></th>
                                    @endforeach
                                    <th><p class="verticalText">%</p></th>
                                    <th><p class="verticalText">Cantidad</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $mes = 0;
                                    $porcentajes = []
                                @endphp
                                @while($mes++ < 12)
                                    <tr>
                                        <td>
                                            @php
                                                setlocale(LC_ALL,"es_ES");
                                                //$dia = cal_days_in_month(CAL_GREGORIAN, $mes, date('Y'));
                                                $dia = date('t', mktime(0, 0, 0, $mes, 1, date('Y')));
                                                $fecha = date("Y-m-d", strtotime(date('Y').'-'.$mes.'-'. $dia));
                                            @endphp
                                            {{ strftime('%b', strtotime(date('Y').'-'.$mes.'-' . $dia)) }} - {{ $dia }} <br>
                                        </td>

                                        @php
                                            $total = 0;
                                            $totalAprobados = 0;
                                            $totalReprobados = 0;
                                        @endphp

                                        @foreach($cursos as $curso)
                                            <td>
                                                @php
                                                    $participantes = \App\Models\Participante::whereHas('evento', function ($q) use ($fecha, $curso){
                                                        $q->whereCursoId($curso->id)->where('fecha_final', '<=', $fecha);
                                                    });
                                                    $totalCurso = $participantes->count();
                                                    $aprobados = $participantes->where('final', '>=', '75')->count();
                                                    $reprobados = $totalCurso - $aprobados;
                                                    if($totalCurso > 0)
                                                        $porcentaje = ($aprobados * 100) / $totalCurso;
                                                    else
                                                        $porcentaje = 0;
                                                    echo round($porcentaje, 2) . '%';

                                                    $total = $total + $totalCurso;
                                                    $totalAprobados = $totalAprobados + $aprobados;
                                                    $totalReprobados = $totalReprobados + $reprobados;
                                                @endphp
                                            </td>
                                        @endforeach
                                        <td>
                                            <strong>
                                                @php
                                                    $porcentajeTotal = 0;
                                                    if($total > 0)
                                                        $porcentajeTotal = ($totalAprobados * 100) / $total;
                                                    $porcentajes[] = $porcentajeTotal;
                                                    echo round($porcentajeTotal, 2) . '%';
                                                @endphp
                                            </strong>
                                        </td>
                                        <td><strong>{{ $total }}</strong></td>
                                    </tr>
                                @endwhile
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <h1 class="text-center"><i
                                class="glyphicon glyphicon-arrow-up"></i> 80%</h1>
                        <div id="container" style="width:100%; height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: '% Cumplimiento mensual'
                },
                subtitle: {
                    text: '{{ date('Y') }}'
                },
                xAxis: {
                    categories: [
                        @php
                            $mes = 0;
                        @endphp
                            @while($mes++ < 12)
                            '{{ strftime('%b', strtotime(date('Y').'-'.$mes.'-17')) }}',
                        @endwhile
                    ]
                },
                yAxis: {
                    title: {
                        text: ''
                    },
                    labels: {
                        formatter: function () {
                            return this.value + '%';
                        }
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        },
                        enableMouseTracking: false,
                    },
                },
                series: [{
                    name: '%',
                    data: [
                        @foreach($porcentajes as $val)
                        {{ $val }},
                        @endforeach
                    ],
                }
                ]
            });

        });
    </script>
@endpush


@extends('layouts.app')

@section('css')
    <style>
        @page {
            size: legal landscape;
        }

        .anchoTabla {
            width: 1500px;
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
            <h1 class="text-center">AVANCE DE CURSOS OBJETIVO</h1>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">

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
                    type: 'column'
                },
                title: {
                    text: '{{ date('Y') }}'
                },
                xAxis: {
                    categories: [
                        @foreach($cursos as $curso)
                            '{{ $curso->nombre }}',
                        @endforeach
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Avance de cursos'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'gray'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y:.2f}<br/>Total: {point.stackTotal}<br/><b>{point.percentage:.2f}%</b><br/>',
                   // shared: true
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [
                    {
                        type: 'column',
                        name: 'Pendientes',
                        data: [
                            @foreach($cursos as $curso)
                            {{ $curso->totales($curso->id) - $curso->aprobados($curso->id) }},
                            @endforeach
                        ]
                    },
                    {
                        type: 'column',
                        name: 'Aprobados',
                        data: [
                            @foreach($cursos as $curso)
                            {{ $curso->aprobados($curso->id) }},
                            @endforeach
                        ]
                    },

                    {
                        type: 'spline',
                        name: 'Cumplimiento',
                        data: [
                            @foreach($cursos as $curso)
                                @if($curso->totales($curso->id) > 0)
                                    {{ ($curso->aprobados($curso->id) * 100 ) / $curso->totales($curso->id) }},
                                @else
                                    {{ 0 }},
                                @endif
                            @endforeach
                        ],
                        tooltip: {
                            valueSuffix: ' %'
                        },
                        marker: {
                            lineWidth: 2,
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white',
                        }
                    },
                ]
            });

        });
    </script>
@endpush


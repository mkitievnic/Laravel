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

            <a href="{{route('eventos.edit', ['evento'=>$evento->id])}}" class="btn btn-default pull-right"
               style="margin-top: -5px;margin-bottom: 5px; margin-right: 5px">
                Volver
            </a>
        </h1>
        <br>
    </section>
    <div class="content">
        @include("reportes.encabezado")

        <div class="box box-primary">
            <h1 class="text-center">RESUMEN DEL EVENTO</h1>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <center>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nro. Evento</th>
                                    <td>{{ $evento->id }}</td>
                                    <th>Instructor</th>
                                    <td>{{ $evento->usuario->persona->nombre_completo }}</td>
                                    <th>Aprobados</th>
                                    <td>{{ $evento->participantes->where('final', '>=', 75)->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de inicio</th>
                                    <td>{{ date("d/m/Y", strtotime($evento->fecha_inicial)) }}</td>
                                    <th>Lugar</th>
                                    <td>{{ $evento->direccion }}</td>
                                    <th>Reprobados</th>
                                    <td>{{ $evento->participantes->count() - $evento->participantes->where('final', '>=', 75)->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de finalización</th>
                                    <td>{{ date("d/m/Y", strtotime($evento->fecha_final)) }}</td>
                                    <th>Convocados</th>
                                    <td>{{ $evento->participantes->count() }}</td>
                                    <th>Asistentes</th>
                                    <td>{{ $evento->participantes->count() - $evento->participantes->whereNull('examen')->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Curso</th>
                                    <td>{{ $evento->curso->nombre }}</td>
                                    <th>Hora</th>
                                    <td>{{ $evento->hora_inicial }} - {{ $evento->hora_final }}</td>
                                    <th>% Eficiencia</th>
                                    <td>{{ ( $evento->participantes->where('final', '>=', 75)->count() * 100 ) / $evento->participantes->count() }}</td>
                                </tr>
                            </table>
                        </center>
                        <h4 class="text-center">PARTICIPANTES</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Legajo</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>Funcion</th>
                                    <th>Asistió</th>
                                    <th>Aprobó</th>
                                    <th>Observaciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $nro = 1;
                                @endphp
                                @foreach($evento->participantes as $participante)
                                    <tr>
                                        <td>{{ $nro++ }}</td>
                                        <td>{{ $participante->empleado->legajo}}</td>
                                        <td>{{ $participante->empleado->nombre_completo }}</td>
                                        <td>{{ $participante->empleado->funcion->nombre }}</td>
                                        <td>{{ $participante->asistio }}</td>
                                        <td>{{ $participante->observacion }}</td>
                                        <td style="width: 300px"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="col-sm-12">
                        <h4 class="text-center">INFORME</h4>
                        <hr>

                        {!! $evento->informe !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.print();
    </script>
@endpush

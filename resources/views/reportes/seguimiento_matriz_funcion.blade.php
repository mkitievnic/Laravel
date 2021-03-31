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
            <h1 class="text-center">SEGUIMIENTO CUMPLIMIENTO MATRIZ POR FUNCIÓN</h1>
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12 onlyview">
                        @if(auth()->user()->nivel !== \App\Patrones\Rol::Inicial)
                            {!! Form::open(['url' => 'reportes/getSeguimientoMatrizPorFuncion/' . date("Y"), 'method'=>'get']) !!}

                            <div class="form-group col-sm-6">
                                {!! Form::label('txtBuscar', 'Bucar por:') !!}
                                {!! Form::text('txtBuscar', isset($_GET['txtBuscar']) ? $_GET['txtBuscar']: null, ['class' => 'form-control', 'placeholder'=>'legajo, nombre']) !!}

                            </div>

                            <div class="form-group col-sm-4">
                                {!! Form::label('txtFuncion', 'Función:') !!}
                                {!! Form::select('txtFuncion', ([null => 'Elija una funcion'] +  \App\Models\Funcion::all()->pluck('nombre', 'id')->toArray()),  isset($_GET['txtFuncion']) ? $_GET['txtFuncion'] : 1, ['class' => 'form-control select2']) !!}
                            </div>

                            <div class="form-group col-sm-2" style="margin-top: 25px">
                                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                    Buscar
                                </button>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>

                    <div class="col-sm-12">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped anchoTabla">
                                <thead>
                                <tr>
                                    <th>Legajo</th>
                                    <th>Apellidos y nombres</th>
                                    <th>Funcion</th>

                                    @foreach($cursos as $curso)
                                        <th style="height: 120px;"><p
                                                class="verticalText"> {{ $curso->nombre }}</p></th>
                                    @endforeach
                                    <th><p class="verticalText">Cumplimiento</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($empleados as $empleado)
                                    <tr>
                                        <td>{{ $empleado->legajo }}</td>
                                        <td style="width: 150px">{{ $empleado->nombre_completo }}</td>
                                        <td>{{ $empleado->funcion->nombre }}</td>

                                        @php
                                            $total = 0;
                                            $aprobados = 0;
                                        @endphp
                                        @foreach($cursos as $curso)
                                            <td class="text-center" style="width: 60px">
                                                @php
                                                    $cursoFuncion = $empleado->funcion->cursoFuncions->where('curso_id', $curso->id)->where('gestion', $gestion)->first();


                                                    if(!is_null($cursoFuncion))
                                                    {
                                                        $total++;

/*
                                                        $participante = \App\Models\Participante::whereEmpleadoId($empleado->id)
                                                            ->whereHas('evento', function($q) use ($curso){
                                                                                $q->whereCursoId($curso->id);
                                                                            })->orderBy('id', 'desc')->first();
                                                        
                                                        */
                                                       $participante = $empleado->participantes()->whereHas('evento', function($q) use ($curso){
                                                                                $q->whereCursoId($curso->id);
                                                                            })->first(); 

                                                        if(!is_null($participante))
                                                        {

                                                            echo $participante->seguimiento['data'];
                                                            if($participante->seguimiento['res'] === 1)
                                                                $aprobados++;
                                                        }
                                                         else{
                                                            

                                                             echo "<span style='color: red'>Pdte</span>";
                                                         }

                                                    }
                                                @endphp
                                            </td>
                                        @endforeach
                                        <td style="width: 50px">
                                            @php
                                                if($total > 0)
                                                {
                                                    echo (($aprobados * 100) / $total); echo "%";
                                                }
                                                else
                                                    echo "0%";
                                            @endphp
                                        </td>
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


@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Dias de franco</h1>
        <br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary" id="appAsignacion">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::open(['route' => 'getAsignar', 'method'=>'get']) !!}

                        <div class="form-group col-sm-2">
                            {!! Form::label('legajo_inicial', 'Legajo Inicial: *') !!}
                            {!! Form::number('legajo_inicial', isset($_GET['legajo_inicial']) ? $_GET['legajo_inicial'] : null, ['class' => 'form-control', 'min' => 1, 'required']) !!}
                        </div>

                        <div class="form-group col-sm-2">
                            {!! Form::label('legajo_final', 'Legajo Final: *') !!}
                            {!! Form::number('legajo_final', isset($_GET['legajo_final']) ? $_GET['legajo_final'] : null, ['class' => 'form-control', 'min'=> 1, 'required']) !!}
                        </div>

                        <div class="form-group col-sm-2">
                            {!! Form::label('fecha_inicial', 'Fecha inicial: *') !!}
                            {!! Form::text('fecha_inicial',isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : date("d/m/Y") , ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'required']) !!}
                        </div>

                        <div class="form-group col-sm-2">
                            {!! Form::label('fecha_final', 'Fecha final: *') !!}
                            {!! Form::text('fecha_final',isset($_GET['fecha_final']) ? $_GET['fecha_final'] :  date('d/m/Y', strtotime(date("Y-m-d") . " +5 day")), ['class' => 'form-control datepicker', 'autocomplete' => 'off', 'required']) !!}
                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('funcion_id', 'Función:') !!}
                            {!! Form::select('funcion_id',[null => 'Todos'] + \App\Models\Funcion::get()->pluck('nombre', 'id')->toArray(),  isset($_GET['funcion_id']) ? $_GET['funcion_id'] : null, ['class' => 'form-control select2']) !!}
                        </div>

                        <div class="form-group col-sm-1" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                @include('dias_francos_asignar.table')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        appAsignacion = new Vue({
            el: "#appAsignacion",
            mounted() {
            },
            methods: {
                asingarFranco(empleado_id, fecha) {
                    let url = "{{ route('asignarFranco', ['pei', 'pfe']) }}".replace('pei', empleado_id).replace('pfe', fecha);
                    axios.post(url).then(response => {
                        if (response.data.res)
                            console.log(response.data.message);
                        else {
                            location.reload();
                            alert("Ha ocurrido un error, pruebe mas tarde")
                        }
                    }).finally(() => {
                    });
                }
            }
        });
    </script>
@endpush


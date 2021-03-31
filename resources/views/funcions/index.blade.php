@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Matriz de funciones</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px"
               href="{{ route('funcions.create') }}">Agregar nueva función</a>
            &nbsp;
            <a class="btn btn-success" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('cursos.create') }}">Agregar nuevo curso</a>
        </h1>
        <br>
    </section>
    <div class="content" id="appMatrizFuncion">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::open(['route' => 'funcions.index', 'method'=>'get']) !!}

                        <div class="form-group col-sm-2">
                            {!! Form::label('gestion', 'Gestión') !!}
                            {!! Form::number('gestion', isset($_GET['gestion']) ? $_GET['gestion'] : date("Y"), ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-5">
                            {!! Form::label('sector', 'Sector:') !!}
                            {!! Form::select('sector', ([null => 'Todos'] +  \App\Models\Sector::all()->pluck('nombre', 'id')->toArray()), isset($_GET['sector']) ? $_GET['sector']: 1, ['class' => 'form-control']) !!}

                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('txtFuncion', 'Función:') !!}
                            {!! Form::text('txtFuncion', isset($_GET['txtFuncion']) ? $_GET['txtFuncion'] : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-2" style="margin-top: 25px">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                Buscar
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                @include('funcions.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        appMatrizFuncion = new Vue({
            el: "#appMatrizFuncion",
            mounted() {
            },
            methods: {
                asingarCurso(curso_id, funcion_id, gestion) {
                    let url = "{{ route('asignarCurso', ['pci', 'pfi', 'ges']) }}".replace('pci', curso_id).replace('pfi', funcion_id).replace('ges', gestion);
                    axios.post(url).then(response => {
                        if (response.data.res)
                            console.log(response.data.message);
                        else
                            alert("Ha ocurrido un error, pruebe mas tarde")
                    });
                }
            }
        });
    </script>
@endpush


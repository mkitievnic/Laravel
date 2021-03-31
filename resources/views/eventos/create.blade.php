@extends('layouts.app')

@section('content')
    <div class="content" id="appEvento">
        <div class="row">

            <div class="col-sm-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Eventos Tentativos</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['route' => 'eventos.create', 'method'=>'get', 'id' => 'frmGenerar']) !!}
                            @include('eventos.search_generate')
                            {!! Form::close() !!}
                            <div class="col-sm-12">
                                @include('eventos.tentativo_table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear nuevo evento</h3>
                    </div>
                    <div class="box-body">
                        <div class="row" v-if="curso.nroParticipantes > 0">
                            {!! Form::open(['route' => 'eventos.store']) !!}
                                @include('eventos.fields', ['esEdit' => !\App\Patrones\Permisos::esAvanzado()])
                                <div class="form-group col-sm-8">
                                    {!! Form::submit('Siguiente >>', ['class' => 'btn btn-primary', 'onclick' => "return confirm('¿Estás seguro?')" ]) !!}
                                    <button type="button" @click="cancelar" class="btn btn-default">
                                        Cancelar
                                    </button>
                                </div>
                                <div class="col-sm-4" style="top: 10px">
                                    Participantes habilitados: <strong>@{{ curso.nroParticipantes }}</strong>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="row" v-else>
                            <div class="col-sm-12">
                                <div class="alert alert-warning">
                                    Ningun alumno habilitado para este curso
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        appEvento = new Vue({
            el: "#appEvento",
            data: {
                curso: {
                    curso: {},
                    fecha: null,
                    nroParticipantes: 0
                }
            },
            mounted() {

            },
            updated() {
                cargarDatePicker();
                $.fn.select2.defaults.set("theme", "bootstrap");
                iniciar_select();
            },
            methods: {
                seleccionarCurso(curso, fecha, nroParticipantes) {
                    this.curso.curso = curso;
                    this.curso.fecha = fecha;
                    this.curso.nroParticipantes = nroParticipantes;
                },
                cancelar() {
                    this.curso = {
                        curso: {},
                        fecha: null,
                        nroParticipantes: 0
                    };
                }
            }
        });
    </script>
@endpush

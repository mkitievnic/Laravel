@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pregunta <br>
            <small>Curso: {{ $curso->nombre }}</small>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">
                    {!! Form::model($pregunta, ['route' => ['preguntas.update', $pregunta->id], 'method' => 'patch']) !!}

                    @include('preguntas.fields')
                    <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('preguntas.index', ['curso_id' => $curso->id]) }}"
                               class="btn btn-default">Volver
                                a la lista de preguntas</a>
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <div class="col-sm-4" id="appRespuesta">
                        <h3 class="pull-left">Respuestas</h3>
                        <h3 class="pull-right">
                            <button type="button" class="btn btn-default pull-right" style="margin-top: -10px"
                                    @click="nuevo">Nueva respuesta
                            </button>
                        </h3>
                        <div class="col-sm-12">
                            <hr>
                            @include("opcions.table")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        appRespuesta = new Vue({
            el: "#appRespuesta",
            data: {
                opciones: [],
                pregunta_id: "{{ $pregunta->id }}"
            },
            mounted() {
                this.getOpciones();
            },
            methods: {
                getOpciones() {
                    let url = "{{ url('opcions?pregunta_id=pid') }}".replace("pid", this.pregunta_id);
                    axios.get(url).then(response => {
                        this.opciones = response.data;
                    });
                },
                nuevo() {
                    let url = "{{ url('opcions_nuevo/pid') }}".replace("pid", this.pregunta_id);
                    axios.post(url).then(response => {
                        this.getOpciones();
                    });
                },
                eliminar(id) {
                    if (confirm("Seguro que quiere eliminar la opcion?")) {
                        let url = "{{ url('opcions/pid') }}".replace("pid", id);
                        axios.delete(url).then(response => {
                            this.getOpciones();
                        });
                    }
                },
                guardarOpcion(respuesta, opcion_id) {
                    if (respuesta.length < 5)
                        toastr.error("Error!! Las respuestasa deben tener mas de 5 caracteres, no se ha guardado la respueta");
                    else {
                        let url = "{{ url('guardarOpcion/pres/pid') }}".replace('pres', respuesta).replace("pid", opcion_id);
                        axios.post(url).then(response => {
                            if(!response.data.res)
                                toastr.error("Error!! Ha ocurrido un error, no se ha guardado la respueta");
                        });
                    }
                },
                guardarOpcionCheck(opcion_id) {
                    let url = "{{ url('guardarOpcionCheck/pid') }}".replace("pid", opcion_id);
                    axios.post(url).then(response => {
                        if(!response.data.res)
                            toastr.error("Error!! Ha ocurrido un error, no se ha guardado la respueta");
                    });
                }
            }
        });
    </script>
@endpush

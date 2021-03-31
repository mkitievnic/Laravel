@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Curso: {{ $evento->curso->informacion }} &nbsp; &nbsp; &nbsp;
            <span class="{{ \App\Patrones\Permisos::getColorEstado($evento->estado) }}">{{ $evento->estado }}</span>
        </h1>

        @if(\App\Patrones\Permisos::esMedio())
            <h1 class="pull-right">
                <a href="{{url('reportes/getResumenEvento/' . $evento->id)}}" class="btn btn-default">
                    <i class="glyphicon glyphicon-print"></i>
                    Impirmir resumen</a>
            </h1>
        @endif
        <br>
        <br>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($evento, ['route' => ['eventos.update', $evento->id], 'method' => 'patch']) !!}
                    @include('eventos.fields', ['esEdit' => !\App\Patrones\Permisos::esAvanzado()])
                    <div class="form-group col-sm-4">
                        <br>
                        @if($evento->es_escritura)
                            @if(\App\Patrones\Permisos::esAvanzado() && $evento->estado === \App\Patrones\EstadoEvento::Pendiente)
                                {!! Form::submit('Publicar evento', ['class' => 'btn btn-success', 'onclick' => "return confirm('¿Seguro que quieres publicar este evento? Ojo: Se van enviar mensajes a los participantes registrados')", 'name' => 'btnPublicar']) !!}
                            @endif
                        @endif

                    </div>

                    <div class="form-group col-sm-8 text-right">
                        @if($evento->es_escritura)
                            <br>
                            @if(\App\Patrones\Permisos::esAvanzado())
                                {!! Form::submit('Cancelar evento', ['class' => 'btn btn-danger', 'onclick' => "return confirm('¿Seguro que quieres cancelar este evento?')", 'name' => 'btnCancelar']) !!}
                                {!! Form::submit('Finalizar evento', ['class' => 'btn btn-info', 'onclick' => "return confirm('¿Seguro que quieres finalizar este evento?')", 'name' => 'btnFinalizar']) !!}
                                ||
                            @endif
                        @endif
                        @if(\App\Patrones\Permisos::esMedio())
                            @if($evento->estado === \App\Patrones\EstadoEvento::EnEjecucion)
                                <button type="button" class='btn btn-default' data-toggle="modal"
                                        data-target="#modalExamen"><i
                                        class="glyphicon glyphicon-edit"></i> Registrar Examen
                                </button>
                                <button type="button" class='btn btn-warning' data-toggle="modal"
                                        data-target="#modalInforme"><i
                                        class="glyphicon glyphicon-file"></i> Registrar Informe
                                </button>
                            @endif
                        @endif
                    </div>

                    @include('eventos.field_informe')

                    {!! Form::close() !!}


                    <div class="col-sm-12" id="appEditEvento">
                        @if(\App\Patrones\Permisos::esMedio())
                            @if(!is_null($evento->examen))
                                @include('examens.show', ['examen' => $evento->examen])
                                <br>
                                <a href="{{ route('enviar.examen', ['evento' => $evento->id]) }}" target="_blank"
                                   class='btn btn-success btn-sm'><i
                                        class="glyphicon glyphicon-send"></i> Enviar link del examen a los participantes
                                </a>
                            @endif
                        @endif
                        <hr>
                        @include('participantes.index', ['participantes' => $evento->participantes])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($evento->examen))
        @include("examens.create", ['examen' => $evento->examen])
    @else
        @include("examens.create")
    @endif
@endsection

@push('scripts')
    <script>
        appEditEvento = new Vue({
            el: "#appEditEvento",
            data: {
                isLoading: false
            },
            mounted() {
            },
            methods: {
                seleccionar(participante_id) {
                    let url = "{{ route('participante.seleccionar', ['ppi']) }}".replace('ppi', participante_id);
                    this.isLoading = true;
                    axios.post(url).then(response => {
                        if (response.data.res)
                            console.log(response.data.message);
                        else
                            alert("Ha ocurrido un error, pruebe mas tarde")
                        this.isLoading = false;
                    });
                }
            }
        });

        $("#searchParticipante").keyup(function () {
            _this = this;
            // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
            $.each($("#participantes-table tbody tr"), function () {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    </script>
@endpush

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluacion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          crossorigin="anonymous">
</head>
<body>

<div class="container" id="appEvaluacion">
    <div class="row">
        <div class="col-sm-12">
            <br>
            <h2 class="text-center"> Evaluación </h2>
            @if(!$evento->examen->esExamenTerminado($participante->id))
                <h3 class="text-center">Tiempo restante: @{{ tiempo }} min @{{ segundos }} seg</h3>
            @endif

            <p>
                <strong>Curso:</strong> {{ $evento->curso->codigo }} : {{ $evento->curso->nombre }} <br>
                <strong>Inicia:</strong> {{ date('d/m/Y', strtotime($evento->examen->fecha_inicial)) }} -
                <strong>Termina:</strong> {{ date('d/m/Y', strtotime($evento->examen->fecha_final)) }} <br>
                <strong>Empleado: </strong> {{ $empleado->nombre_completo }} -
                <strong>Función: </strong> {{ $empleado->funcion->nombre }}
            </p>

            @if($evento->examen->esExamenTerminado($participante->id))
                <hr>
                <div style="text-align: center">
                    Terminó el examen, su calificación es:
                    <h1>{{ $evento->examen->calificacionParticipante($participante->id) }}</h1>
                </div>

                @if($evento->examen->calificacionParticipante($participante->id) >= 75)
                    <div class="alert alert-success text-center">Aprobado !</div>
                @else
                    <div class="alert alert-danger text-center">Reprobado !</div>
                @endif

                <div class="text-center">
                    <small>Correctas: {{ $evento->examen->cantRespuestasCorrectas($participante->id) }} </small> -
                    <small>Incorrectas: {{ \App\Patrones\Fachada::$cantPreguntas - $evento->examen->cantRespuestasCorrectas($participante->id) }} </small>
                </div>
            @else
                <div>
                    <p style="text-align: center;" id="iniciar" v-if="!esIniciado">
                        <button class="btn btn-info btn-lg" @click="iniciarExamen">Iniciar Examen</button>
                    </p>

                    <div id="examen" style="display:none">
                        <ul>
                            @php
                                $nro = 1;
                            @endphp
                            @foreach($preguntas as $pregunta)
                                <hr>
                                <li>
                                    Pregunta {{ $nro++ }} : {!! $pregunta->pregunta !!}
                                    @php
                                        $opciones = \App\Models\Opcion::wherePreguntaId($pregunta->id)->get();
                                    @endphp
                                    @foreach($opciones as $opcion)
                                        <div class="form-check" style="margin-left: 20px">
                                            {!! Form::radio('opcion'. $opcion->pregunta_id, null, null, ['class' => 'form-check-input', '@click' => "registrarRespuesta($opcion)"]) !!}
                                            <label class="form-check-label" for="{{ 'opcion'. $opcion->pregunta_id }}">
                                                &nbsp;&nbsp;
                                                ( {{ $opcion->letra }} )
                                                &nbsp;&nbsp;&nbsp; {!! $opcion->respuesta !!}</label>
                                        </div>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>

                        <p style="text-align: center;" id="iniciar">
                            <button class="btn btn-success btn" @click="finalizarExamen">Finalizar y Enviar</button>
                        </p>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

<script>
    appEvaluacion = new Vue({
        el: "#appEvaluacion",
        data: {
            esIniciado: false,
            tiempo: "{{ $evento->examen->tiempo }}",
            segundos: 60,
            esConcluio: "{{ $evento->examen->esExamenTerminado($participante->id) }}"
        },
        created() {
            this.esIniciado = false;
        },
        mounted(){
            if(this.esConcluio)
            {
                this.registrar_nota();
            }
        },
        methods: {
            iniciarExamen() {
                if (confirm("Estas seguro que quieres iniciar tu examen?")) {
                    $("#examen").css("display", "inline");
                    this.esIniciado = true;

                    //registrando una respuesta al azr
                    let data = {letra: "Z", respuesta: "no sirve", es_correcto: false};
                    this.registrarRespuesta(data);
                }
            },
            async recargar() {
                this.esIniciado = false;
                await $("#examen").css("display", "none");
                location.reload();
            },
            finalizarExamen() {
                if (confirm("Estas seguro que quieres finalizar y enviar tu examen?")) {
                    this.recargar();
                }
            },
            registrarRespuesta(res) {
                let url = "{{ url('respuestas') }}";
                axios.post(url, {
                    ...res, ...{
                        participante_id: "{{ $participante->id }}",
                        examen_id: "{{ $evento->examen->id }}"
                    }
                }).then(response => {
                    if (response.data.res)
                        console.log(response.data.message);
                    else {
                        alert("Ha ocurrido un error, pruebe nuevamente")
                    }
                }).finally(() => {
                });
            },
            async registrar_nota(){
                //registrar la nota del participante
                let url = await "{{ url('registrar_nota/pid/pnota') }}".replace("pid", "{{ $participante->id }}").replace("pnota", "{{ $evento->examen->calificacionParticipante($participante->id) }}");
                axios.put(url).then(response => {
                    if (response.data.res) {
                        console.log(response.data.message);
                    } else {
                        alert("Ha ocurrido un error, pruebe nuevamente")
                    }
                });
            },
            async contador() {
                if (this.esIniciado) {
                    this.segundos = await this.segundos - 1;

                    //segundos
                    if (this.segundos <= 0) {
                        this.segundos = 60;
                        this.tiempo = await this.tiempo - 1;
                    }

                    //finalizando automaticamente
                    if (this.tiempo < 0) {
                        this.tiempo = 0;
                        this.segundos = 0;

                        this.recargar();
                    }
                }
            }
        }
    });

    // function askConfirmation (evt) {
    //     if(appEvaluacion.esIniciado)
    //     {
    //         var msg = 'Cuidado Si recarga la página mandarás el examen con las respuestas que tengas.\n¿Deseas recargar la página?';
    //         evt.returnValue = msg;
    //         return msg;
    //     }
    // }
    // window.addEventListener('beforeunload', askConfirmation);
    window.onbeforeunload = function () {
        if (appEvaluacion.esIniciado) {
            return "Confirm Reload" + 'Cuidado Si recarga la página mandarás el examen con las respuestas que tengas.\n¿Deseas recargar la página?';
        }
    };

    setInterval(appEvaluacion.contador, 1000)
</script>

</html>

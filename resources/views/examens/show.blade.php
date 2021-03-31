<strong>Examen: </strong>
Inicia: {{ date('d/m/Y', strtotime($examen->fecha_inicial)) }}
Termina: {{ date('d/m/Y', strtotime($examen->fecha_final)) }} &nbsp; &nbsp;
Descripción:
{{ $examen->descripcion }} &nbsp; &nbsp; Tiempo
[minutos]: {{ $examen->tiempo }} &nbsp; &nbsp;
Estado: {{ $examen->estado ? 'Publicado' : 'No publicado' }}

Hola <strong>{{ $data['nombre'] }}</strong>,
<p>
    Información para el examen:
</p>

<h1 style="text-align: center;">{{ $data['evento'] }}</h1>

<p>Fecha: {{ $data['fecha_inicial'] }}</p>
<p>Detalle: {{ $data['descripcion'] }}</p>
<p>Tiempo: {{ $data['tiempo'] }}</p>

<h3>URL examen</h3>
<h1 style="text-align: center;">
    <a href="{{ $data['url'] }}">Entra al examen</a>
</h1>

<hr>
<small>&copy; San Antonio</small>

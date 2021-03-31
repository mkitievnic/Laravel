Hola <strong>{{ $data['nombre'] }}</strong>,
<p>
    Material del evento:
</p>

<h1 style="text-align: center;">{{ $data['evento'] }}</h1>

<h3>URL del material</h3>
<h1 style="text-align: center;">
    <a href="{{ $data['url'] }}">Descargar material</a>
</h1>

<hr>
<small>&copy; San Antonio</small>

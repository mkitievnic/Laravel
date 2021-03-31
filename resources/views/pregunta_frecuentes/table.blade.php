<div class="table-responsive">
    <table class="table" id="preguntaFrecuentes-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Pregunta</th>
            <th>Respuesta</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro = 1;
        @endphp
        @foreach($preguntaFrecuentes as $preguntaFrecuente)
            <tr>
                <td>{{$nro++}}</td>
                <td>{{ $preguntaFrecuente->pregunta }}</td>
                <td>{{ $preguntaFrecuente->respuesta }}</td>
                <td>{{ $preguntaFrecuente->usuario_id }}</td>
                <td>
                    {!! Form::open(['route' => ['preguntaFrecuentes.destroy', $preguntaFrecuente->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('preguntaFrecuentes.show', [$preguntaFrecuente->id]) }}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i> Json</a>
                        <a href="{{ route('preguntaFrecuentes.edit', [$preguntaFrecuente->id]) }}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

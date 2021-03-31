<div class="table-responsive">
    <table class="table table-bordered table-striped" id="cursos-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Duración <br> [Horas]</th>
            <th>Vencimiento <br> [Años]</th>
            <th>Estado</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro = 1;
        @endphp
        @foreach($cursos as $curso)
            <tr>
                <td>{{ $nro++ }}</td>
                <td>{{ $curso->codigo }}</td>
                <td>{{ $curso->nombre }}</td>
                <td>{{ $curso->duracion }}</td>
                <td>{{ $curso->vencimiento }}</td>
                <td>
                    @if($curso->estado)
                        <span class="label label-success">Vigente</span>
                    @else
                        <span class="label label-danger">No vigente</span>
                    @endif
                </td>
                <td style="width: 230px">
                    {!! Form::open(['route' => ['cursos.destroy', $curso->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('materials.index', ['curso_id' => $curso->id]) }}" class='btn btn-info btn-xs'><i
                                class="glyphicon glyphicon-book"></i> Materiales</a>
                        <a href="{{ route('preguntas.index', ['curso_id' => $curso->id]) }}" class='btn btn-warning btn-xs'><i
                                class="glyphicon glyphicon-list"></i> Preguntas</a>
                        <a href="{{ route('cursos.edit', [$curso->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

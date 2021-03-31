<div class="table-responsive">
    <table class="table table-striped table-bordered" id="preguntas-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Pregunta</th>
            <th>Estado</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro = 1;
        @endphp
        @foreach($preguntas as $pregunta)
            <tr>
                <td style="width: 40px">{{ $nro++ }}</td>
                <td>{!! $pregunta->pregunta !!}</td>
                <td style="width: 50px">
                    @if($pregunta->estado)
                        <span class="label label-success">Vigente</span>
                    @else
                        <span class="label label-danger">No vigente</span>
                    @endif
                </td>
                <td style="width: 70px">
                    {!! Form::open(['route' => ['preguntas.destroy', $pregunta->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('preguntas.edit', [$pregunta->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Seguro que quiere eliminar la pregunta?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

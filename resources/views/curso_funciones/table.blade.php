<div class="table-responsive">
    <table class="table table-bordered table-striped" id="funcions-table">
        <thead>
        <tr>
            <th>Gestión</th>
            <th>Código</th>
            <th>Nombre del curso</th>
            <th>Duración</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cursoFunciones as $curso)
            <tr>
                <td style="width: 100px">{{ $curso->gestion}}</td>
                <td style="width: 100px">{{ $curso->curso->codigo}}</td>
                <td>{{ $curso->curso->nombre }}</td>
                <td style="width: 80px">{{ $curso->curso->duracion }}</td>
                <td style="width: 180px">
                    {!! Form::open(['route' => ['cursoFuncions.destroy', $curso->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="instructors-table">
        <thead>
        <tr>
            <td>#</td>
            <th>Ci</th>
            <th>Nombre del instructor</th>
            <th>Telefono</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro =  ($instructors->currentPage() - 1 ) * $instructors->perPage() + 1;
        @endphp
        @foreach($instructors as $instructor)
            <tr>
                <td style="width: 50px">{{ $nro++ }}</td>
                <td>{{ $instructor->ci }} {{ $instructor->expedido }}</td>
                <td>{{ $instructor->nombre_completo }}</td>
                <td>{{ $instructor->telefono }}</td>
                <td>{{ $instructor->proveedor->nombre }}</td>
                <td class="text-muted">
                    @if(!is_null($instructor->usuario))
                        Cuenta: {{ $instructor->usuario->email }} <br>
                        <strong>Nivel: {{ $instructor->usuario->nivel }} </strong>
                        <br>
                        @if($instructor->usuario->alta)
                            <span class="label label-success">Alta</span>
                        @else
                            <span class="label label-danger">Baja</span>
                        @endif
                    @endif
                </td>
                <td style="width: 150px">
                    {!! Form::open(['route' => ['instructors.destroy', $instructor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('users.edit', [$instructor->usuario->id]) }}" class='btn btn-info btn-xs'><i
                                class="glyphicon glyphicon-user"></i> Usuario</a>
                        <a href="{{ route('instructors.edit', [$instructor->id]) }}" class='btn btn-default btn-xs'><i
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

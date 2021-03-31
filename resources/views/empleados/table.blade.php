<div class="table-responsive">
    <table class="table table-bordered table-striped" id="empleados-table" style="width: 1500px">
        <thead>
        <tr>
            <th>#</th>
            <th>Legajo</th>
            <th>Ci</th>
            <th>Nombres y apellidos</th>
            <th>Email</th>
            <th>Función</th>
            <th>Proveedor</th>
            <th>Usuario</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro =  ($empleados->currentPage() - 1 ) * $empleados->perPage() + 1;
        @endphp
        @foreach($empleados as $empleado)
            <tr>
                <td style="width: 50px">{{ $nro++ }}</td>
                <td>{{ $empleado->legajo }}</td>
                <td style="width: 120px">{{ $empleado->ci }} {{ $empleado->expedido }}</td>
                <td style="width: 200px">{{ $empleado->nombre_completo }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ !is_null($empleado->funcion) ? $empleado->funcion->nombre : '' }}</td>
                <td>{{ $empleado->proveedor->nombre }}</td>
                <td class="text-muted" style="width: 180px">
                    @if(!is_null($empleado->usuario))
                        Cuenta: {{ $empleado->usuario->email }} <br>
                        <strong>Nivel: {{ $empleado->usuario->nivel }} </strong>
                        <br>
                        @if($empleado->usuario->alta)
                            <span class="label label-success">Alta</span>
                        @else
                            <span class="label label-danger">Baja</span>
                        @endif
                    @endif
                </td>
                <td style="width: 350px">
                    @if($empleado->id !== auth()->user()->persona->id)
                        {!! Form::open(['route' => ['empleados.destroy', $empleado->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @if($empleado->usuario)
                            <a href="{{ route('users.edit', [$empleado->usuario->id]) }}" class='btn btn-info btn-xs'><i
                                    class="glyphicon glyphicon-user"></i> Usuario</a>
                            @endif
                            <a href="{{ route('diaFrancos.index', ["empleado_id" => $empleado->id ]) }}"
                               class='btn btn-warning btn-xs'><i
                                    class="glyphicon glyphicon-list"></i> Dias de franco</a>
                            <br>
                            <a href="{{ route('empleados.edit', [$empleado->id]) }}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i> Editar</a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

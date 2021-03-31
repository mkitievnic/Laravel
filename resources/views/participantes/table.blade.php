<div class="table-responsive">
    <table class="table table-striped table-bordered" id="participantes-table">
        <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th>Legajo</th>
            <th>Nombre Completo</th>
            <th>Examen</th>
            <th>Nota Final</th>
            <th>Observación</th>
            <th>Gestión</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro = 1;
        @endphp
        @foreach($participantes as $participante)
            <tr>
                <td style="width: 10px">
                    @if(\App\Patrones\Permisos::esMedio())
                        <input type="checkbox"
                               name="listaParticipantes"
                               @click="seleccionar('{{ $participante->id }}')" :disabled="isLoading">
                    @endif
                </td>
                <td style="width: 20px">{{ $nro++ }}</td>
                <td style="width: 20px">{{ $participante->empleado->legajo }}</td>
                <td style="width: 600px">
                    {{ $participante->empleado->nombre_completo }} <br>
                    <sup class="text-muted">{{ $participante->empleado->funcion->nombre }} | {{ $participante->empleado->email }}</sup>
                </td>
                <td style="width: 50px">{{ $participante->examen }}</td>
                <td style="width: 50px">{{ $participante->final }}</td>
                <td style="width: 80px">{{ $participante->observacion }}</td>
                <td style="width: 50px">{{ $participante->gestion }}</td>
                <td style="width: 50px">
                    @if(\App\Patrones\Permisos::esAvanzado())
                        @if($evento->es_escritura)
                            {!! Form::open(['route' => ['participantes.destroy', $participante->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Seguro que quieres eliminar a este participante de la lista?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

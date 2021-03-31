<div class="table-responsive">
    <table class="table table-striped table-bordered" id="eventos-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Curso</th>
            <th>Instructor</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Horario</th>
            <th>Dirección</th>
            <th># Part.</th>
            <th>Estado</th>
            @if(isset($area_estudiante))
                <th>Notal Final</th>
            @endif
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro =  ($eventos->currentPage() - 1 ) * $eventos->perPage() + 1;
        @endphp
        @foreach($eventos as $evento)
            <tr>
                <td>{{ $nro++ }}</td>
                <td style="width: 150px">{{ $evento->curso->nombre }} <br>{{ $evento->id }} </td>
                <td>{{ $evento->usuario->persona->nombre_completo }}</td>
                <td>{{ date('d/m/Y', strtotime($evento->fecha_inicial)) }}</td>
                <td>{{ date('d/m/Y', strtotime($evento->fecha_final))}}</td>
                <td>{{ $evento->hora_inicial }} - {{ $evento->hora_final }}</td>
                <td>{{ $evento->direccion }}</td>
                <td style="width: 50px" class="text-center">{{ $evento->participantes->count() }}</td>
                <td>
                    <span
                        class="{{ \App\Patrones\Permisos::getColorEstado($evento->estado) }}">{{ $evento->estado }}</span>
                </td>
                @if(isset($area_estudiante))
                    <td>
                        <small>
                            Validez: {{ $evento->curso->vencimiento }} Años <br>
                            Fecha Caducidad: {{ date('d/m/Y', strtotime($evento->fecha_caducidad)) }}
                            <strong>Estado: {{ $evento->estaVigente }}</strong>
                        </small>
                    </td>
                @endif
                <td style="width: 70px">
                    <div class='btn-group'>
                        <a href="{{ route('eventos.edit', [$evento->id]) }}" class='btn btn-info btn-xs btn-block'
                           title="Modificar"><i
                                class="glyphicon glyphicon-eye-open"></i> Detalles <br>del Curso</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

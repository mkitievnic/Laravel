@if(isset($cursos))
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Curso</th>
                <th>Fecha</th>
                <th># Par</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cursos as $row)
                @foreach($row['cursos'] as $curso)
                    <tr>
                        <td style="width: 280px">{{ $curso->nombre }}</td>
                        <td>{{ date("d/m/Y", strtotime($row['fecha'])) }}</td>
                        <td><strong>{{ $curso->participantes($curso->id, $row['fecha']) }}</strong></td>
                        <td>
                            <button class='btn btn-info btn-xs btn-block' title="Agregar nuevo Evento" @click="seleccionarCurso({{ $curso }}, '{{  date("d/m/Y", strtotime($row['fecha'])) }}', {{ $curso->participantes($curso->id, $row['fecha']) }})">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endif

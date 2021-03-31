<div class="table-responsive">
    <table class="table table-bordered table-striped" id="funcions-table">
        <thead>
        <tr>
            <th>Función</th>

            @foreach($cursos as $curso)
                <th style="height: 120px;"><p
                        class="verticalText"> {{ $curso->nombre }}</p></th>
            @endforeach

            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($funcions as $funcion)
            <tr>
                <td>{{ $funcion->nombre }} <br>
                </td>

                @foreach($cursos as $curso)
                    <td class="text-center">
                        @php
                            $cursoFuncion = $funcion->cursoFuncions->where('curso_id', $curso->id)->where('gestion', $gestion)->first();
                        @endphp
                        <input type="checkbox" :checked="'{{ !is_null($cursoFuncion) }}'"
                               name="asignado" id="asignado"
                               @click="asingarCurso('{{ $curso->id }}','{{ $funcion->id }}', '{{ $gestion }}')">
                    </td>
                @endforeach

                <td style="width: 80px">
                    {!! Form::open(['route' => ['funcions.destroy', $funcion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('funcions.edit', [$funcion->id]) }}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
{{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}--}}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="empleados-table">
        <thead>
        <tr>
            <th style="vertical-align: middle">Legajo / Ci</th>
            <th style="vertical-align: middle">Nombres y apellidos</th>

            @php
                $dias = $fechaInicio->diff($fechaFinal)->days;
                $i = 0;
            @endphp
            @while ($i <= $dias)
                @php
                    $fecha = date('Y-m-d', strtotime($fechaInicio->format("Y-m-d") . " + " . $i . " day"));
                @endphp
                <th style="height: 100px; vertical-align: middle;">
                   <p class="verticalText">{{ date('d/m/Y', strtotime($fecha))}}</p>
                </th>
                @php
                    $i++;
                @endphp
            @endwhile

        </tr>
        </thead>
        <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <td style="width: 130px">Legajo: {{ $empleado->legajo }} <br>
                    Ci: {{ $empleado->ci }} {{ $empleado->expedido }}</td>
                <td style="width: 250px">{{ $empleado->nombre_completo }} <br>
                    <small>Función: {{ $empleado->funcion->nombre }}</small>
                </td>

                @php
                    $i = 0;
                @endphp
                @while ($i <= $dias)
                    @php
                        $fecha = date("Y-m-d", strtotime($fechaInicio->format("Y-m-d") . " + " . $i . " day"));
                        $fechaEsp = date("Y-m-d", strtotime($fechaInicio->format("Y-m-d") . " + " . $i . " day"));
                        $franco = $empleado->diasFranco()->where('fecha', $fechaEsp)->first();
                    @endphp
                    <td style="text-align: center">
                        <input type="checkbox" :checked="'{{ !is_null($franco) }}'"
                               name="dia_franco" id="dia_franco"
                               @click="asingarFranco('{{ $empleado->id }}','{{ $fecha }}')">
                    </td>
                    @php
                        $i++;
                    @endphp
                @endwhile
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="respuestas-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Respuesta</th>
            <th>Es <br>Correcto?</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(opcion, index) in opciones" :key="index">
            <td style="width: 20px">@{{ opcion.letra }}</td>
            <td>
                <textarea v-model="opcion.respuesta" required style="width: 100%" @blur="guardarOpcion(opcion.respuesta, opcion.id)" minlength="5" maxlength="50"></textarea>
            </td>
            <td style="width: 30px; text-align: center">
                <input type="radio" :checked="opcion.es_correcto" name="es_correcto" @click="guardarOpcionCheck(opcion.id)">
            </td>
            <td style="width: 40px">
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs', '@click' => "eliminar(opcion.id)"]) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

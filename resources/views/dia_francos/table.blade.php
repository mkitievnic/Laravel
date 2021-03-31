<div class="table-responsive">
    <table class="table table-bordered table-striped" id="diaFrancos-table">
        <thead>
        <tr>
            <th>Fechas de franco</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($diaFrancos as $diaFranco)
            <tr>
                <td>{{ date('d/m/Y', strtotime($diaFranco->fecha)) }}</td>
                <td>
                    {!! Form::open(['route' => ['diaFrancos.destroy', $diaFranco->id], 'method' => 'delete']) !!}
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

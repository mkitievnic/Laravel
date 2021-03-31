<div class="table-responsive">
    <table class="table table-bordered table-striped" id="materials-table">
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Url</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <td>{{ $material->descripcion }}</td>
                <td>{{ $material->url }}</td>
                <td style="width: 140px">
                    {!! Form::open(['route' => ['materials.destroy', $material->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ asset('materiales/' . $material->url) }}" target="_blank" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i> Ver material</a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

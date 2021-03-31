<div class="table-responsive">
    <table class="table table-striped table-bordered" id="proveedors-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro = 1;
        @endphp
        @foreach($proveedors as $proveedor)
            <tr>
                <td style="width: 30px">{{ $nro++ }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td style="width: 100px">
                    {!! Form::open(['route' => ['proveedors.destroy', $proveedor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('proveedors.edit', [$proveedor->id]) }}" class='btn btn-default btn-xs'><i
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

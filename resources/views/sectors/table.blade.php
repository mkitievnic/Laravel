<div class="table-responsive">
    <table class="table table-bordered table-striped" id="sectors-table">
        <thead>
        <tr>
            <td>#</td>
            <th>Nombre</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php
            $nro = 1;
        @endphp
        @foreach($sectors as $sector)
            <tr>
                <td style="width: 50px">{{ $nro++ }}</td>
                <td>{{ $sector->nombre }}</td>
                <td style="width: 100px">
                    {!! Form::open(['route' => ['sectors.destroy', $sector->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('sectors.edit', [$sector->id]) }}" class='btn btn-default btn-xs'><i
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

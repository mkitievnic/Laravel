<div class="row">
    <div class="col-sm-12">
        <h3 class="pull-left">Lista de Participantes</h3>
        <h3 class="pull-right">
            @if(\App\Patrones\Permisos::esAvanzado())
                <button type="button" class="btn btn-primary btn-sm" style="margin-top: -10px;margin-bottom: 5px"
                        data-toggle="modal" data-target="#modalParticipante">
                    <i class="glyphicon glyphicon-plus"></i> Agregar nuevo estudiante
                </button>
                <a href="{{ route('eventos.show', ['evento' => $evento->id]) }}" target="_blank" class="btn btn-default btn-sm" style="margin-top: -10px;margin-bottom: 5px">
                    <i class="glyphicon glyphicon-send"></i> Enviar publicación de evento
                </a>
            @endif
            @if(\App\Patrones\Permisos::esMedio())
                <a href="{{ route('get_material', ['curso_id' => $evento->curso_id, 'evento' => $evento->id]) }}" target="_blank" class="btn btn-default btn-sm" style="margin-top: -10px;margin-bottom: 5px">
                    <i class="glyphicon glyphicon-send"></i> Enviar material
                </a>
            @endif
        </h3>
    </div>
    <div class="col-sm-12">
        @include('participantes.create')

        <input type="text" class="form-control" id="searchParticipante" placeholder="Escribe para buscar..." />
        @include('participantes.table')
    </div>
</div>

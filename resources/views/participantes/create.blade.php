<!-- Modal -->
<div id="modalParticipante" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar un nuevo participante</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'participantes.store']) !!}

                @include('participantes.fields')

                {!! Form::close() !!}
            </div>
            <div class="modal-footer" style="border-top: none">
            </div>
        </div>

    </div>
</div>

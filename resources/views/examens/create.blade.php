<!-- Modal -->
<div id="modalExamen" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar examen</h4>
            </div>
            <div class="modal-body">
                @if(isset($examen))
                    {!! Form::model($examen, ['route' => ['examens.update', $examen->id], 'method' => 'patch']) !!}
                @else
                    {!! Form::open(['route' => 'examens.store']) !!}
                @endif

                @include('examens.fields')

                {!! Form::close() !!}
            </div>
            <div class="modal-footer" style="border-top: none">
            </div>
        </div>

    </div>
</div>

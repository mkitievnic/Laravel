<!-- Modal -->
<div id="modalInforme" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar informe del instructor</h4>
            </div>
            <div class="modal-body">

                <div class="form-group col-sm-12 col-lg-12">
                    {!! Form::label('informe', 'Informe del instructor: *') !!}
                    {!! Form::textarea('informe', null, ['class' => 'form-control summernotepregunta']) !!}
                </div>

            </div>
            <div class="modal-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success', 'onclick' => "return confirm('¿Seguro que quires guardar el informe?')", 'name' => 'btnInforme']) !!}
            </div>
        </div>

    </div>
</div>

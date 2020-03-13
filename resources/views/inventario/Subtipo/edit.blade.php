
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Subtipo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <input style="display:none" type="text" class="form-control" id="IdSubTipo" name="IdSubTipo" value="{{$subtipo->IdSubTipo}}">
                <form id="SubTipoFormEdit" name="SubTipoFormEdit">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Tipo:</label>
                        <select class="form-control" id="IdTipo" name="IdTipo">
                            @foreach ($tipos as $tipo)
                                <option value="{{$tipo->IdTipo}}"
                                    @if ($tipo->IdTipo == $subtipo->IdTipo)
                                        selected
                                    @endif
                                >{{$tipo->Nombre}}</option>
                            @endforeach

						</select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nombre:</label>
                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="{{$subtipo->Nombre}}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_actualizar_subtipo">Actualizar</button>
        </div>
    </div>
</div>

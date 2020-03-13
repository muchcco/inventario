
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Tipo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <input style="display:none" type="text" class="form-control" id="IdTipo" name="IdTipo" value="{{$tipo->IdTipo}}">
                <form id="TipoFormEdit" name="TipoFormEdit">

                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nombre:</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" value="{{$tipo->Nombre}}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_actualizar_tipo">Actualizar</button>
        </div>
    </div>
</div>

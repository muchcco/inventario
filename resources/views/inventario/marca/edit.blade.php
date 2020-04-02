
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Marca</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <input style="display:none" type="text" class="form-control" id="MarcaId" name="MarcaId" value="{{$marca->IdMarca}}">
                <form id="MarcaFormEdit" name="MarcaFormEdit">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nombre:</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" value="{{$marca->Nombre}}" onkeyup="MayusculaGuiones(this)">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_actualizar_marca">Actualizar</button>
        </div>
    </div>
</div>

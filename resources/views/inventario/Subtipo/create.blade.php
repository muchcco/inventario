
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar SubTipo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="SubTipoForm" name="SubTipoForm">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Tipo:</label>
                        <select class="form-control" id="IdTipo" name="IdTipo">
                            @foreach ($tipos as $tipo)
                            <option value="{{$tipo->IdTipo}}">{{$tipo->Nombre}}</option>
                            @endforeach

						</select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nombre:</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_guardar_subtipo">Guardar</button>
        </div>
    </div>
</div>

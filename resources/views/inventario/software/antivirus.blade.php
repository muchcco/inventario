
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar Antivirus</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="AntivirusForm" name="AntivirusForm">
                    @csrf
                    <input type="hidden" class="form-control" id="Tipo" name="Tipo" value="AV">
                    <div class="form-group validated">
                        <label for="recipient-name" class="form-control-label">Nombre:</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" onkeyup="MayusculaGuiones(this)">
                        <div class="invalid-feedback" id="valid_nombre" name="valid_nombre"></div>
                    </div>
                    <div class="form-group validated">
                        <label for="recipient-name" class="form-control-label">Version:</label>
                        <input type="text" class="form-control" id="Version" name="Version" onkeyup="MayusculaGuiones(this)">
                        <div class="invalid-feedback" id="valid_version" name="valid_version"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <a onclick="guardarAV()" class="btn btn-primary" id="btn_guardar_marca">Guardar</a>
        </div>
    </div>
</div>

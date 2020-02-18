
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar Modelo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="ModeloForm" name="ModeloForm">
                    <div class="form-group ">
                        <label class="form-control-label">Marca</label>
                        <div class="">
                            <select class="form-control kt-selectpicker" name="id_marca" id="id_marca">
                                @foreach( $marcas as $marca )
                                    <tr>
                                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                    </tr>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="form-control-label">Nombre Modelo:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_guardar_modelo">Guardar</button>
        </div>
    </div>
</div>

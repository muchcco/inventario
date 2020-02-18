
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Modelo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <input type="text" class="form-control" id="ModeloId" name="ModeloId" value="{{$modelo->modeloid}}" style="display:none">
                <form id="ModeloFormEdit" name="ModeloFormEdit">
                    <div class="form-group ">
                        <label class="form-control-label">Modelo</label>
                        <div class="">
                            <select class="form-control kt-selectpicker" name="id_marca" id="id_marca">
                                @foreach( $marcas as $marca )
                                    <tr>
                                        <option value="{{ $marca->id }}"
                                            @if($marca->id == $modelo->marcaid)
                                                selected
                                            @endif

                                            >{{ $marca->nombre }}</option>
                                    </tr>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="form-control-label">Nombre Modelo:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$modelo->modelonombre}}">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_actualizar_modelo">Actualizar</button>
        </div>
    </div>
</div>

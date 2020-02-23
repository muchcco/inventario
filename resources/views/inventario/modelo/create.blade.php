
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
                        <label class="form-control-label">Tipo</label>

                            <select class="form-control kt-selectpicker" name="IdTipo" id="IdTipo">
                                @foreach( $tipos as $tipo )
                                    <tr>
                                        <option value="{{ $tipo->IdTipo }}">{{ $tipo->Nombre }}</option>
                                    </tr>
                                @endforeach

                            </select>

                    </div>
                    <div class="form-group ">
                        <label class="form-control-label">SubTipos</label>

                            <select class="form-control kt-selectpicker" name="IdSubTipo" id="IdSubTipo">
                            </select>

                    </div>
                    <div class="form-group ">
                            <label class="form-control-label">Marca</label>

                                <select class="form-control kt-selectpicker" name="IdMarca" id="IdMarca">
                                        @foreach( $marcas as $marca )
                                        <tr>
                                            <option value="{{ $marca->IdMarca }}">{{ $marca->Nombre }}</option>
                                        </tr>
                                    @endforeach
                                </select>

                    </div>

                    <div class="form-group">
                        <label for="nombre" class="form-control-label">Nombre Modelo:</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre">
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

<script>


$(document).ready(function () {
    //CARGAR COMBO SUBTIPO

    var tipo = document.getElementById('IdTipo');
    var cargarSAubtipo = () => {
        ajaxRequest(
            "{{ route('inventario.modelo.subtipos') }}",
            'POST',
            {tipo : tipo.value},
            function(response){
                let SubTipos = '<option value="">Seleccione SubTipo</option>'
                for (var i=0; i<response.length;i++){
                    SubTipos+='<option value="'+response[i].IdSubTipo+'">'+response[i].Nombre+'</option>';
                }
                $("#IdSubTipo").html(SubTipos)
        });
    }
    cargarSAubtipo();
    tipo.addEventListener('change', (event) => {

        ajaxRequest(
            "{{ route('inventario.modelo.subtipos') }}",
            'POST',
            {tipo : event.target.value},
            function(response){
                let SubTipos = '<option value="">Seleccione SubTipo</option>'
                for (var i=0; i<response.length;i++){
                    SubTipos+='<option value="'+response[i].IdSubTipo+'">'+response[i].Nombre+'</option>';
                }
                $("#IdSubTipo").html(SubTipos)
        });
    });

})
</script>


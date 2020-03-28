
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Reasignar Equipo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="FormAsignar" name="FormAsignar">
                    <input type="hidden" value="{{$Equipo}}" id="IdEquipo" name="IdEquipo">
                    <div class="form-group validated">
                        <label for="recipient-name" class="form-control-label">Responsable:</label>
                        <select style="width: 100%"  class="custom-select form-control col-lg-12" style="width: 100%" id="responsable" name="responsable" data-col-index="7">
                            <option value="">Seleccionar</option>
                        </select>
                        <div class="invalid-feedback" id="valid_responsable" name="valid_responsable"></div>
                    </div>
                    <div class="form-group validated">
                        <label for="recipient-name" style="width: 100%" class="form-control-label">Usuario:</label>
                        <select style="width: 100%"  class=" custom-select form-control col-lg-12" id="usuario" name="usuario"  data-col-index="7" >
                            <option value="">Seleccionar</option>
                        </select>
                        <div class="invalid-feedback" id="valid_usuario" name="valid_usuario"></div>
                    </div>
                    <div class="form-group validated">
                        <label>Fecha Inicio</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="FAsignacion"  name="FAsignacion" autocomplete="off" placeholder="Seleccionar Fecha" />
                        </div>
                        <div class="invalid-feedback" id="valid_fasignacion" name="valid_fasignacion"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-form-label">Utilizado</label>
                        <div class="col-3">
                            <span class="kt-switch">
                                <label>
                                <input type="checkbox"  name="Utilizado" id="Utilizado"/>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
        <a class="btn btn-primary" onclick="asignado()">Guardar</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        CargarUsuariosRea();
        CargarResponsablesRea();

        $("#FAsignacion").datepicker( {
                language:"es",
                todayHighlight: !0,
                format: "dd/mm/yyyy",
                rtl: KTUtil.isRTL(),
                todayHighlight: !0,
                orientation: "bottom left",
            }
            ).on('changeDate', function(e) {
                document.getElementById('valid_fasignacion').innerHTML = "";
            });
});
//CARGAR COMBO USUARIO SELECT 2
var CargarUsuariosRea = () => {
            var url = "{{ route('inventario.asignacionhistorico.buscar_personal') }}";

            $("#usuario").select2( {

                language: {
                    noResults: function() {
                    return "No hay resultado";
                    },
                    searching: function() {
                    return "Buscando..";
                    }
                },
                ajax: {
                        url: url,
                        processResults: function (data) {

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {results: data}
                        }
                    }
                }
            )
        }

//CARGAR COMBO RESPONSABLE SELECT 2
var CargarResponsablesRea = () => {
            var url = "{{ route('inventario.asignacionhistorico.buscar_personal') }}";

            $("#responsable").select2( {

                language: {
                    noResults: function() {
                    return "No hay resultado";
                    },
                    searching: function() {
                    return "Buscando..";
                    }
                },
                ajax: {
                        url: url,
                        processResults: function (data) {

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {results: data}
                        }
                    }
                }
            )
        }

</script>

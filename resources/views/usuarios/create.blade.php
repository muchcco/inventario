
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuarrio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="MarcaForm" name="MarcaForm">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nombres y Apellidos:</label>
                        <input type="text" class="form-control" id="UsuarioNombre" name="name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Email:</label>
                        <input type="email" class="form-control" id="UsuarioEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Password:</label>
                        <input type="password" class="form-control" id="UsuarioPassword" name="password">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Rol:</label>
                        <select class="form-control kt-selectpicker" name="role_id" id="role_id">
                            @foreach( $roles as $role )
                                <tr>
                                    <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                                </tr>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
						<label style="width: 100%">Dependencia</label>
						<select style="width: 100%" class=" form-control " id="IdDependencia" name="IdDependencia">
                            <option  selected="selected">--SELECCIONE DIRECCION --</option>
                          </select>
					</div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_guardar_marca">Guardar</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        cargarDependencia()
    });
    var cargarDependencia = () => {
        var url = "{{ route('usuarios.dependencia') }}";

        $("#IdDependencia").select2( {
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

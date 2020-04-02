<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <form id="UsuarioFormEdit" name="UsuarioFormEdit">
                    <input type="hidden" class="form-control" id="UpdateUsuarioId" name="UpdateUsuarioId" value="{{$usuarios->uid}}">

                    <div class="form-group ">
                        <div class="">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$usuarios->un}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$usuarios->ue}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{$usuarios->up}}">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Rol:</label>
                                    <select class="form-control kt-selectpicker" name="role_id" id="role_id">
                                        @foreach( $roles as $role )
                                            <tr>
                                                <option {{ $role->id == $usuarios->ri ? "selected" : "" }} value="{{ $role->id }}">{{ $role->nombre }}</option>
                                            </tr>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="width: 100%">Dependencia</label>
                                    <select style="width: 100%" class=" form-control " id="IdDependenciaudp" name="IdDependencia">
                                    <option  selected="selected" value="{{$usuarios->IdDependencia}}">{{$usuarios->Dependencia}}</option>
                                      </select>
                                </div>

                        </div>
                    </div>
                </form>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <button type="button" class="btn btn-primary" id="btn_actualizar_usuario">Actualizar</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        cargarDependenciaupd()
    });
    var cargarDependenciaupd = () => {
        var url = "{{ route('usuarios.dependencia') }}";

        $("#IdDependenciaudp").select2( {
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


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
                        <select class="form-control kt-selectpicker" name="role_id" id="role_id">
                            @foreach( $roles as $role )
                                <tr>
                                    <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                                </tr>
                            @endforeach

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

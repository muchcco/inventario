
			<!--begin::Form-->
            <form class="kt-form" id="FormCrearPersonal" name="FormCrearPersonal" method="POST">
                @method('POST')
                @csrf
				<div class="kt-portlet__body">
                    <div class="form-group validated">
						<label>DNI</label>
						<div class="input-group">
                            <input type="text" class="form-control" name="DNI" id="DNI">

							<div class="input-group-append">
                                <a class="btn btn-success "  onclick="cargarDatos()" name="buscar" id="buscar"  style="color: #fff">Buscar</a>

                            </div>

                        </div>
                        <span class="form-text text-muted" id="alerta_DNI" name="alerta_DNI"></span>
                        <div class="invalid-feedback" id="valid_personal" name="valid_personal"></div>
					</div>
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control" id="Nombres" name="Nombres" readonly="readonly">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApePat" name="ApePat"  readonly="readonly">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApeMat" name="ApeMat"  readonly="readonly">
                    </div>
                    <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" id="Email" name="Email">
                    </div>
					<div class="form-group">
						<label>Anexo</label>
						<input type="text" class="form-control" id="Anexo" name="Anexo">
                    </div>
					<div class="form-group">
						<label >Contrato</label>
						<select class="form-control" id="TipoContr" name="TipoContr">
							<option value="CAS">CAS</option>
							<option value="CAP">CAP</option>
							<option value="RHE">RHE</option>
						</select>
					</div>
					<div class="form-group validated">
						<label for="IdDependencia" class="col-md-12">Dependencia</label>
						<select class="form-control" style="width:100%" id="IdDependencia" name="IdDependencia">
                            <option value="0"  selected="selected">--SELECCIONE DIRECCION --</option>
                          </select>
                          <div class="invalid-feedback" id="valid_dependencia" name="valid_dependencia"></div>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
                    <a name="guardar_personal" id="guardar_personal" onclick="GuardarPersonal('{{ $tipo }}')" class="btn btn-primary" disabled>Guardar</a>
						<a  class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
            <!--end::Form-->


            <script>

                cargarDependencia()

                //VALIDAR FORMULARIO PERSONAL

            </script>


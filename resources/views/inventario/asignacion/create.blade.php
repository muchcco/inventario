
@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
<script href="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}" rel="stylesheet" type="text/css" ></script>
<script>



    $( document ).ready(function() {
        cargarDependencia()
    //cargar datos al al encontrar el dni

    });

    var  cargarDatos = () =>{

            DNI = document.getElementById("DNI").value;
            document.getElementById("buscar").innerHTML = "Buscando ";
            document.getElementById("buscar").disabled = true;
            ajaxRequest(
                "{{ route('generales.personal.buscar') }}",
                'POST',
                {dni : DNI},
                function(response){
                    if (response[0]["codigo"] == null) {
                        document.getElementById("alerta_DNI").innerHTML = `<div class="alert alert-solid-danger alert-bold" role="alert">
                             <div class="alert-text">A ocurrido un error al buscar el DNI</div>
                         </div>`
                        document.getElementById("guardar_personal").disabled = true;
                        document.getElementById("buscar").innerHTML = "Buscar ";
                        document.getElementById("buscar").disabled = false;
                    }
                    if (response[0]["codigo"] == 1){
                        document.getElementById("alerta_DNI").innerHTML = `<div class="alert alert-solid-warning alert-bold" role="alert">
                             <div class="alert-text">El usuario ${response[0]["Nombres"]} ya fue registrado </div>
                         </div>`
                        document.getElementById("Nombres").value = response[0]["Nombres"];
                        document.getElementById("ApePat").value = response[0]["ApePat"];
                        document.getElementById("ApeMat").value = response[0]["ApeMat"];
                        document.getElementById("Email").value = response[0]["Email"];
                        document.getElementById("Anexo").value = response[0]["Anexo"];
                        document.getElementById("TipoContr").value = response[0]["TipoContr"];
                        document.getElementById("IdDependencia").innerHTML = `<option value="${response[0]["IdDependencia"]}">${response[0]["Dependencia"]}`;
                        document.getElementById("guardar_personal").disabled = true;
                        document.getElementById("buscar").innerHTML = "Buscar ";
                        document.getElementById("buscar").disabled = false;
                        return true;
                    }else {
                        if (response[0]["codigo"] == "0000"){
                            document.getElementById("alerta_DNI").innerHTML = ``;
                            document.getElementById("Nombres").value = response[0]["Nombres"];
                            document.getElementById("ApePat").value = response[0]["ApePat"];
                            document.getElementById("ApeMat").value = response[0]["ApeMat"];
                            document.getElementById("Email").value = "";
                            document.getElementById("Anexo").value = "";
                            document.getElementById("IdDependencia").innerHTML = `<option  selected="selected">--SELECCIONE DIRECCION --</option>`;
                            document.getElementById("guardar_personal").disabled = false;
                            document.getElementById("buscar").innerHTML = "Buscar ";
                            document.getElementById("buscar").disabled = false;
                            return true;
                        }
                    }
            });
    }

    //Cargar datos usando del responsable y usuario
    var BuscarPersonal = (tipo,tip) => {
        var url = "{{ route('generales.personal.busqueda') }}";
        var parametro = document.getElementById(`parametro${tip}`).value;
        ajaxRequest(
            url,
            "post",
            {tipo: tipo,parametro: parametro},
            function(data){

                inputparametro =document.querySelectorAll(`[id^='parametro']`);
                inputparametro.forEach(element => {
                    element.value = parametro;
                });
                //console.log(inputparametro);
                $("#tipo").html(tipo);
                $("#tabla_asignar_personal_body").html(data);
                $("#asignar_personal").modal('show');
            }
        );
    };

    //Cargar datos del ASIGNADO
    var AsignarPersonal = (tipo,IdPersonal,dni,Nombres,dependencia) => {
        document.getElementById(`tipo_datos_${tipo}`).innerHTML = `<b>DATOS DEL ${tipo.toUpperCase()}</b>`;
        document.getElementById(`datos_${tipo}`).innerHTML =    `<b>DNI: </b> ${dni}<br>`+
                                                                `<b>Nombre: </b> ${Nombres}<br>`+
                                                                `<b>Dependencia: </b> ${dependencia} <br>`+
                                                                `<div class="border-top my-3"></div>`
        document.getElementById("IdUsuarioActual").value = IdPersonal;
        $("#asignar_personal").modal('hide');
    };
    </script>
@endsection
@section('content')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<!--begin::Portlet-->
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Asignacion
					</h3>
				</div>
			</div>
			<!--begin::Form-->
            <form class="kt-form" action="{{ route('generales.personal.store') }}" method="POST">
                @method('POST')
                @csrf
				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>Resposable</label>
						<div class="input-group">
                            <input type="text" class="form-control" name="parametro" id="parametro" placeholder="Digite DNI o Nombre del personal" onkeyup="javascript:this.value=this.value.toUpperCase();">

							<div class="input-group-append">
                                <a class="btn btn-success "  onclick="BuscarPersonal('responsable','')" name="buscar" id="buscar"  style="color: #fff">Buscar</a>

                            </div>
                        </div>
                        <span class="form-text text-muted" id="alerta_DNI" name="alerta_DNI"></span>
                    </div>
                    <div>
                        <div class="kt-wizard-v2__content">
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__review-item">
                                    <div class="kt-wizard-v2__review-title" name="tipo_datos_responsable" id="tipo_datos_responsable">

                                    </div>
                                    <div class="kt-wizard-v2__review-content"  name="datos_responsable" id="datos_responsable">

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="IdUsuarioActual" id="IdUsuarioActual">
                        </div>
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
					<div class="form-group">
						<label for="">Dependencia</label>
						<select class="js-example-data-ajax form-control" id="IdDependencia" name="IdDependencia">

                          </select>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" name="guardar_personal" id="guardar_personal" class="btn btn-primary" disabled>Guardar</button>
						<a href="{{route('generales.personal.index')}}" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>

	</div>

</div>
<!--begin: Modal crear marca-->
<div class="modal fade" id="asignar_personal" name="asignar_personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tipo" name="tipo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="parametro_modal" id="parametro_modal" onkeyup="javascript:this.value=this.value.toUpperCase();">

                            <div class="input-group-append">
                                <a class="btn btn-success "  onclick="BuscarPersonal('responsable','_modal')" name="buscar" id="buscar"  style="color: #fff">Buscar</a>

                            </div>
                        </div>
                    </div>
                    <div class="offset-md-3">

                    </div>
                </div>
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_asignar_personal">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Dependencia</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_asignar_personal_body">
                    </tbody>
                </table>
            <div class="modal-body">
        </div>
    </div>
</div>
<!--end: Modal crear marca-->

@endsection


@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.es.js')}}" charset="UTF-8" ></script>

<script>



    $( document ).ready(function() {
        AsignarPersonal('responsable','{{$responsable->IdPersonal}}','{{$responsable->DNI}}','{{$responsable->Nombres}} {{$responsable->ApePat}} {{$responsable->ApeMat}}','{{$responsable->Dependencia}}')
        AsignarPersonal('usuario','{{$usuario->IdPersonal}}','{{$usuario->DNI}}','{{$usuario->Nombres}} {{$usuario->ApePat}} {{$usuario->ApeMat}}','{{$usuario->Dependencia}}')

        $("#FAsignacion").datepicker( {
                language:"es",
                todayHighlight: !0,
                format: "dd/mm/yyyy",
                orientation: "bottom left",
                startDate: "{{ date('d/m/Y', strtotime($asignado->FAsignacion)) }}"
            }
            ).on('changeDate', function(e) {
                document.getElementById('valid_fasignacion').innerHTML = "";
            });
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

    var cargarDependencia = () => {
            var url = "{{ route('generales.personal.dependencia') }}";

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
    //Cargar datos usando del responsable y usuario
    var BuscarPersonal = (tipo,tip) => {
        var url = "{{ route('generales.personal.busqueda') }}";
        var parametro = document.getElementById(`parametro${tip}`).value;
        ajaxRequest(
            url,
            "post",
            {tipo: tipo,parametro: parametro},
            function(data){
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
        document.getElementById(tipo).value = IdPersonal;
        document.getElementById(`valid_${tipo}`).innerHTML = "";
        $("#asignar_personal").modal('hide');
    };
    //Agregar personal
    var CrearPersonal = () => {
        var url = "{{ route('generales.personal.agregarmodal') }}";
        ajaxRequest(
            url,
            "post",
            {},
            function(data){
                $("#crear_personal_modal_body").html(data);
                $("#asignar_personal").modal('hide');
                $("#crear_personal_modal").modal('show');
                return true;
                //console.log(inputparametro);

                $("#tabla_asignar_personal_body").html(data);
                $("#asignar_personal").modal('show');
            }
        );
    }

    //Validar crear Asignacion
    var validar_formulario_asignacion = () => {
        var usuario = document.forms["crear_asignacion"]["responsable"].value;
        if (usuario == "") {
            document.getElementById('valid_responsable').innerHTML = "Se debe seleccionar un responsable"
            return false;
        }
        var responsable = document.forms["crear_asignacion"]["usuario"].value;
        if (responsable == "") {
            document.getElementById('valid_usuario').innerHTML = "Se debe seleccionar un usuario"
            return false;
        }
        var responsable = document.forms["crear_asignacion"]["FAsignacion"].value;
        if (responsable == "") {
            document.getElementById('valid_fasignacion').innerHTML = "Se debe seleccionar una fecha de asignación"
            return false;
        }
    }

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
            <div class="kt-portlet__body">
            <form class="kt-form" action="{{ route('inventario.asignacion.reasignado',['asignacion'=>$asignado->IdAsignacion]) }}" method="POST" onsubmit="return validar_formulario_asignacion()" id="crear_asignacion" name="crear_asignacion">
                @method('PUT')
                @csrf
                    <input type="hidden" name="IdEquipo" id="IdEquipo" value="{{$asignado->IdEquipo}}">
                    <div class="form-group validated" >
						<label>Resposable</label>
						<div class="input-group">
                            <input type="text" class="form-control" name="parametro" id="parametro" placeholder="Digite DNI o Nombre del personal" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<div class="input-group-append">
                                <a class="btn btn-success "  onclick="BuscarPersonal('responsable','')" name="buscar" id="buscar"  style="color: #fff">Buscar</a>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="valid_responsable" name="valid_responsable"></div>
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
                            <input type="hidden" class="form-control" name="responsable" id="responsable">
                        </div>
                    </div>


                    <div class="form-group validated">
						<label>Usuario</label>
						<div class="input-group">
                            <input type="text" class="form-control" name="parametro" id="parametro" placeholder="Digite DNI o Nombre del personal" onkeyup="javascript:this.value=this.value.toUpperCase();">
							<div class="input-group-append">
                                <a class="btn btn-success "  onclick="BuscarPersonal('usuario','')" name="buscar" id="buscar"  style="color: #fff">Buscar</a>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="valid_usuario" name="valid_usuario"></div>
                    </div>
                    <div>
                        <div class="kt-wizard-v2__content">
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v2__review-item">
                                    <div class="kt-wizard-v2__review-title" name="tipo_datos_usuario" id="tipo_datos_usuario">

                                    </div>
                                    <div class="kt-wizard-v2__review-content"  name="datos_usuario" id="datos_usuario">

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="usuario" id="usuario">
                        </div>
                    </div>


                    <div class="form-group validated">
                        <label>Fecha Inicio</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="FAsignacion" value="{{ date('d/m/Y', strtotime($asignado->FAsignacion)) }}" name="FAsignacion" autocomplete="off" placeholder="Seleccionar Fecha" />
                        </div>
                        <div class="invalid-feedback" id="valid_fasignacion" name="valid_fasignacion"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-form-label">Utilizado</label>
                        <div class="col-3">
                            <span class="kt-switch">
                                <label>
                                <input type="checkbox"  name="Utilizado" id="Utilizado" {{$asignado->Utilizado == 1 ? "checked" : ""}}/>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" name="guardar_asignacion" id="guardar_asignacion" class="btn btn-primary">Reasignar</button>
						<a href="{{route('inventario.equipo.subtipo', ['subtipo'=> $subTipos->Nombre])}}" class="btn btn-secondary">Cancel</a>
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
                    <div class="offset-md-7 col-md-2">
                        <a class="btn btn-success "  name="buscar" id="buscar" onclick="CrearPersonal()"  style="color: #fff">Agregar</a>
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
            </div>
        </div>
    </div>
</div>
<!--end: Modal crear marca-->
<!--begin: Modal crear personal-->
<div class="modal fade" id="crear_personal_modal" name="crear_personal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="crear_personal_modal_body" name="crear_personal_modal_body">


            </div>
        </div>
    </div>
</div>
<!--end: Modal crear personal-->
@endsection

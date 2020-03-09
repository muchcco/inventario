
@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('script')
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




        //console.log(document.getElementById("dni").value);
        //alert("!3")
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
						Nuevo Personal
					</h3>
				</div>
			</div>
			<!--begin::Form-->
            <form class="kt-form" action="{{ route('generales.personal.store') }}" method="POST">
                @method('POST')
                @csrf
				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>DNI</label>
						<div class="input-group">
                            <input type="text" class="form-control" name="DNI" id="DNI" value="44761105">

							<div class="input-group-append">
                                <button class="btn btn-success "  onclick="cargarDatos()" name="buscar" id="buscar"  style="color: #fff">Buscar</button>

                            </div>

                        </div>
                        <span class="form-text text-muted" id="alerta_DNI" name="alerta_DNI"></span>
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
                            <option  selected="selected">--SELECCIONE DIRECCION --</option>
                          </select>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" name="guardar_personal" id="guardar_personal" class="btn btn-primary" disabled>Guardar</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>

	</div>

</div>


@endsection

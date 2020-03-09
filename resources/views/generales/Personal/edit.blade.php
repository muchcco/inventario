
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
                        document.getElementById("Dependencia").innerHTML = `<option value="${response[0]["IdDependencia"]}">${response[0]["Dependencia"]}`;
                        document.getElementById("guardar_personal").disabled = "true";
                        return true;
                    }else {

                    }

                    document.getElementById("Nombres").value = response.prenombres;
                    document.getElementById("ApePat").value = response.apPrimer;
                    document.getElementById("ApeMat").value = response.apSegundo;
            });




        //console.log(document.getElementById("dni").value);
        //alert("!3")
    }


    var cargarDependencia = () => {
            var url = "{{ route('generales.personal.dependencia') }}";

            $("#Dependencia").select2( {
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
						Actualizar Personal
					</h3>
				</div>
            </div>
			<!--begin::Form-->
            <form class="kt-form" id="Form_Empleado_update" name="Form_Empleado_update" action="{{ route('generales.personal.update',$personal->IdPersonal) }}" method="POST">
                    @method('PUT')
                    @csrf

				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>DNI</label>
                            <input type="text" class="form-control" name="DNI" id="DNI" disabled="disabled" value="{{$personal->DNI}}">
					</div>
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control" id="Nombres" name="Nombres" disabled="disabled" value="{{$personal->Nombres}}">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApePat" name="ApePat"  disabled="disabled" value="{{$personal->ApePat}}">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApeMat" name="ApeMat"  disabled="disabled" value="{{$personal->ApeMat}}">
                    </div>
                    <div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" id="Email" name="Email" value="{{$personal->Email}}">
                    </div>
					<div class="form-group">
						<label>Anexo</label>
						<input type="text" class="form-control" id="Anexo" name="Anexo" value="{{$personal->Anexo}}">
                    </div>
					<div class="form-group">
						<label >Contrato</label>
						<select class="form-control" name="TipoContr" id="TipoContr">
							<option value="CAS" {{ $personal->TipoContr == "CAS" ? "selected" : ""  }}>CAS</option>
							<option value="CAP" {{ $personal->TipoContr == "CAP" ? "selected" : ""  }}>CAP</option>
							<option value="RHO" {{ $personal->TipoContr == "RHO" ? "selected" : ""  }}>RHO</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleSelect2">Dependencia</label>
						<select class="js-example-data-ajax form-control" id="Dependencia" name="Dependencia">
                            <option  selected="selected" value="{{$personal->IdDependencia}}">{{$personal->NomDependencia}}</option>
                          </select>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" name="guardar_personal" id="guardar_personal" class="btn btn-primary">Actualizar</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>

	</div>

</div>


@endsection

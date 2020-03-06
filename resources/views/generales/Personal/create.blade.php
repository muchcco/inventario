
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
						Nuevo Personal
					</h3>
				</div>
			</div>
			<!--begin::Form-->
			<form class="kt-form">
				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>DNI</label>
						<div class="input-group">
							<input type="text" class="form-control" name="DNI" id="DNI">
							<div class="input-group-append">
								<a class="btn btn-success "  onclick="cargarDatos()" name="buscar" id="buscar"  style="color: #fff">Buscar</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control" id="Nombres" name="Nombres" disabled="disabled">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApePat" name="ApePat"  disabled="disabled">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApeMat" name="ApeMat"  disabled="disabled">
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
						<select class="form-control" id="TipoContr" id="TipoContr">
							<option value="CAS">CAS</option>
							<option value="CAP">CAP</option>
							<option value="RHO">RHO</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleSelect2">Dependencia</label>
						<select class="js-example-data-ajax form-control" id="Dependencia" name="Dependencia">
                            <option  selected="selected">--SELECCIONE DIRECCION --</option>
                          </select>
					</div>
				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="reset" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->

		<!--begin::Portlet-->

		<!--end::Portlet-->
	</div>

</div>


@endsection

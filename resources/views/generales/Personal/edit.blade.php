
@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('script')
<script href="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}" rel="stylesheet" type="text/css" ></script>
<script>



    $( document ).ready(function() {
        cargarDependencia()
    });



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
                            <input type="text" class="form-control" name="DNI" id="DNI" readonly="readonly" value="{{$personal->DNI}}">
					</div>
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" class="form-control" id="Nombres" name="Nombres" readonly="readonly" value="{{$personal->Nombres}}">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApePat" name="ApePat"  readonly="readonly" value="{{$personal->ApePat}}">
					</div>
					<div class="form-group">
						<label>Apellido Paterno</label>
						<input type="text" class="form-control" id="ApeMat" name="ApeMat"  readonly="readonly" value="{{$personal->ApeMat}}">
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
							<option value="RHE" {{ $personal->TipoContr == "RHE" ? "selected" : ""  }}>RHE</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Dependencia</label>
						<select class="js-example-data-ajax form-control" id="IdDependencia" name="IdDependencia">
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


@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

<script>


    $(document).ready(function () {
        //CARGAR COMBO SUBTIPO

        var marca = document.getElementById('IdMarca');
        var cargarModelos = () => {
            ajaxRequest(
                "{{ route('inventario.modelo.modelos') }}",
                'POST',
                {marca : marca.value},
                function(response){

                    let Modelos = '<option value="">--SELECCIONAR MODELOS--</option>'
                    for (var i=0; i<response.length;i++){
                        Modelos+='<option value="'+response[i].IdModelo+'">'+response[i].Nombre+'</option>';
                    }
                    $("#IdModelo").html(Modelos)
            });
        }
        cargarModelos();
        marca.addEventListener('change', (event) => {

            ajaxRequest(
                "{{ route('inventario.modelo.modelos') }}",
                'POST',
                {marca : event.target.value},
                function(response){

                    let Modelos = '<option value="">--SELECCIONAR MODELOS--</option>'
                    for (var i=0; i<response.length;i++){
                        Modelos+='<option value="'+response[i].IdModelo+'">'+response[i].Nombre+'</option>';
                    }
                    $("#IdModelo").html(Modelos)
            });
        });

    })
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
						{{$crtpdt}} {{$subt->Nombre}}
					</h3>
				</div>
			</div>
            <!--begin::Form-->
            <form class="kt-form" action="{{ route('inventario.equipo.subtipo_store') }}" method="POST">
                @method('POST')
                @csrf
				<div class="kt-portlet__body">
                    <div class="form-group">
						<label>Tipo</label>
						<div class="input-group">
                            <input type="text" class="form-control" name="NomTipo" id="NomTipo" value="{{$tipo->Nombre}}" readonly="readonly">
                            <input type="hidden"  name="IdTipo" id="IdTipo" readonly="readonly">
                        </div>
					</div>
					<div class="form-group">
						<label>SubTipo</label>
						<input type="text" class="form-control" name="NomSubTipo" id="NomSubTipo" value="{{$subt->Nombre}}" readonly="readonly">
                        <input type="hidden"  name="IdSubTipo" id="IdSubTipo" readonly="readonly">
					</div>
					<div class="form-group">
                        <label>Marca</label>
                        <select class="form-control" id="IdMarca" name="IdMarca">
							@foreach ($marcas as $marca)
                                <option value="{{$marca->IdMarca}}">{{$marca->Nombre}}</option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
                        <label>Modelo</label>
                        <select class="form-control" id="IdModelo" name="IdModelo">

						</select>
					</div>
                    <div class="form-group">
						<label>IP</label>
						<input type="text" class="form-control" id="IP" name="IP" value="{{$equipo->IP}}">
                    </div>
                    <div class="form-group">
						<label>Host</label>
						<input type="text" class="form-control" id="Host" name="Host" value="{{$equipo->Host}}">
                    </div>
                    <div class="form-group">
						<label>Codigo Patrimonial</label>
						<input type="text" class="form-control" id="CodPatrimonial" name="CodPatrimonial" value="{{$equipo->CodPatrimonial}}">
                    </div>
                    <div class="form-group">
						<label>Serie</label>
						<input type="text" class="form-control" id="NumSerie" name="NumSerie" value="{{$equipo->NumSerie}}">
                    </div>

				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
                        <button type="submit" name="guardar_equipo" id="guardar_equipo" class="btn btn-primary">
                            <i class="la la-check"></i>Guardar y Asignar
                        </button>

						<a href="{{route('generales.personal.index')}}" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>

	</div>

</div>


@endsection

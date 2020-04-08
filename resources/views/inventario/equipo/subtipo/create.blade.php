
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
                {marca : marca.value,subtipo: "{{$subt->IdSubTipo}}"},
                function(response){

                    let Modelos = `<option value="">--SELECCIONAR--</option>`
                    for (var i=0; i<response.length;i++){

                        Modelos+=`<option value="${response[i].IdModelo}"  ${response[i].IdModelo == "{{ $equipo->IdModelo }}" ? "selected" : "" }>${response[i].Nombre}</option>`;
                    }
                    $("#IdModelo").html(Modelos)
            });
        }
        cargarModelos();
        marca.addEventListener('change', (event) => {

            ajaxRequest(
                "{{ route('inventario.modelo.modelos') }}",
                'POST',
                {marca : marca.value,subtipo: "{{$subt->IdSubTipo}}"},
                function(response){

                    let Modelos = `<option value="">--SELECCIONAR--</option>`
                    for (var i=0; i<response.length;i++){
                        Modelos+=`<option value="${response[i].IdModelo}" ${response[i].IdModelo == "{{ $equipo->IdModelo }}" ? "selected" : "" }>${response[i].Nombre}</option>`;

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
            @if ($crtpdt == "Nuevo")
            <form class="kt-form" action="{{ route('inventario.equipo.subtipo_store') }}" method="POST">
                @method('POST')
                @csrf
            @else
            <form class="kt-form" action="{{ route('inventario.equipo.subtipo_update',['Equipo'=>$equipo->IdEquipo]) }}" method="POST">
                @method('PUT')
                @csrf
            @endif

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
                                <option value="{{$marca->IdMarca}}"  {{ $equipo->IdMarca == $marca->IdMarca ? "selected" : "" }}>{{$marca->Nombre}}</option>
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
						<label>Capacidad</label>
						<input type="text" class="form-control" id="DiscoDuro" name="DiscoDuro" value="{{$equipo->DiscoDuro}}">
                    </div>
                    <div class="form-group">
						<label>Codigo Patrimonial</label>
						<input type="text" class="form-control" id="CodPatrimonial" name="CodPatrimonial" {{ $crtpdt == "Editar" ? "readonly='readonly'" : "" }} value="{{$equipo->CodPatrimonial}}">
                    </div>
                    <div class="form-group">
						<label>Serie</label>
						<input type="text" class="form-control" id="NumSerie" name="NumSerie" {{ $crtpdt == "Editar" ? "readonly='readonly'" : "" }} value="{{$equipo->NumSerie}}">
                    </div>

				</div>
				<div class="kt-portlet__foot">
					<div class="kt-form__actions">
                        <button type="submit" name="guardar_equipo" id="guardar_equipo" class="btn btn-primary">
                            <i class="la la-check"></i>{{ $crtpdt == "Nuevo" ? "Guardar y Asignar" : "Actualizar y ver Asignacion" }}
                        </button>

						<a href="{{route('inventario.equipo.subtipo', ['subtipo'=> $subt->Nombre])}}"class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>

	</div>

</div>


@endsection

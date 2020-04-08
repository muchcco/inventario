
@extends('layout')

@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
.select2-results__option[aria-selected=true] {
    display: none;
}
</style>
@endsection

@section('script')
<script href="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}" rel="stylesheet" type="text/css" ></script>
<script>
    $(document).ready(function () {
        CargarSO();
        CargarSW();
        CargarAV();

    });

    //BOTON AGREGAR SISTEMA OPERATIVO
    var agregarSO = () => {
            $.ajax({
                type:'get',
                url:"{{ route('inventario.software.create_so') }}",
                dataType: "json",
                data:{},
                success:function(data){
                    $("#modal_software").html(data.html);
                    $("#modal_software").modal('show');
                }
            });
    }
    //GUARDAR SISTEMA OPERATIVO
    var guardarSO = () => {
        var createForm = $("#SisOpeForm").serializeArray();
        if (createForm[2]["value"] == "" || createForm[2]["value"] == null ) {
            $("#valid_nombre").html("Debe digitar el nombre");
            return false;
        }
        if (createForm[3]["value"] == "" || createForm[3]["value"] == null ) {
            $("#valid_version").html("Debe digitar la versión");
            return false;
        }


            ajaxRequest(
                    "{{ route('inventario.software.store_so') }}",
                    'POST',
                    createForm,
                    function(response){
                        $("#modal_software").modal('hide');

                });
    }
    //BOTON AGREGAR SISTEMA OPERATIVO
    var agregarAV = () => {
            $.ajax({
                type:'get',
                url:"{{ route('inventario.software.create_av') }}",
                dataType: "json",
                data:{},
                success:function(data){
                    $("#modal_software").html(data.html);
                    $("#modal_software").modal('show');
                }
            });
    }
    //GUARDAR SISTEMA OPERATIVO
    var guardarAV = () => {
        var createForm = $("#AntivirusForm").serializeArray();
        if (createForm[2]["value"] == "" || createForm[2]["value"] == null ) {
            $("#valid_nombre").html("Debe digitar el nombre");
            return false;
        }
        if (createForm[3]["value"] == "" || createForm[3]["value"] == null ) {
            $("#valid_version").html("Debe digitar la versión");
            return false;
        }


            ajaxRequest(
                    "{{ route('inventario.software.store_av') }}",
                    'POST',
                    createForm,
                    function(response){
                        $("#modal_software").modal('hide');

                });
    }
    //BOTON AGREGAR PROGRAMA
    var agregarPrograma = () => {
            $.ajax({
                type:'get',
                url:"{{ route('inventario.software.create_sw') }}",
                dataType: "json",
                data:{},
                success:function(data){
                    $("#modal_software").html(data.html);
                    $("#modal_software").modal('show');
                }
            });
    }
    //GUARDAR PROGRAMA
    var guardarPrograma = () => {
        var createForm = $("#ProgramaForm").serializeArray();
        if (createForm[2]["value"] == "" || createForm[2]["value"] == null ) {
            $("#valid_nombre").html("Debe digitar el nombre");
            return false;
        }
        if (createForm[3]["value"] == "" || createForm[3]["value"] == null ) {
            $("#valid_version").html("Debe digitar la versión");
            return false;
        }


            ajaxRequest(
                    "{{ route('inventario.software.store_sw') }}",
                    'POST',
                    createForm,
                    function(response){
                        $("#modal_software").modal('hide');

                });
    }
    //CARGAR COMBO DE SISTEMA OPERATIVO
        var CargarSO = () => {
            var url = "{{ route('inventario.software.so') }}";

            $("#SistOperativo").select2( {
                type: 'select2:select',
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
                            var param = [];
                           // param = {id:'',text:'TODOS'}
                            data.splice(0, 0, param);
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {results: data}
                        }
                    }
                }
            )
        }
    //CARGAR SOFTWARE MULTISELECT
        var CargarSW = () => {
            var url = "{{ route('inventario.software.sw') }}";

            $("#IdSoftware").select2( {
                type: 'select2:select',
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
                            var param = [];
                           // param = {id:'',text:'TODOS'}
                            data.splice(0, 0, param);
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {results: data}
                        }
                    }
                }
            )
        }

        //CARGAR ANTIVIRUS
        var CargarAV = () => {
        var url = "{{ route('inventario.software.av') }}";

            $("#Antivirus").select2( {
                type: 'select2:select',
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
                            var param = [];
                           // param = {id:'',text:'TODOS'}
                            data.splice(0, 0, param);
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {results: data}
                        }
                    }
                }
            )
        }
    //MAYUSCULAS
        var MayusculaGuiones = (valor) => {
            valor.value = valor.value.toUpperCase();
            //valor.value = valor.value.replace(/\s/g,"_");
            //console.log(valor);

            //javascript:this.value=this.value.toUpperCase();
        }



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
                {marca : event.target.value,subtipo: "{{$subt->IdSubTipo}}"},
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
	<div class="col-md-10 offset-md-1">
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
                    <div class="row kt-section">
                        <h3 class="kt-section__title col-lg-12">Datos generales</h3>
                        <div class="form-group col-lg-3">
                            <label>Tipo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="NomTipo" id="NomTipo" value="{{$tipo->Nombre}}" readonly="readonly">
                                <input type="hidden"  name="IdTipo" id="IdTipo" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>SubTipo</label>
                            <input type="text" class="form-control" name="NomSubTipo" id="NomSubTipo" value="{{$subt->Nombre}}" readonly="readonly">
                            <input type="hidden"  name="IdSubTipo" id="IdSubTipo" readonly="readonly">
                        </div>

                        <div class="form-group col-lg-3">
                            <label>Marca</label>
                            <select class="form-control" id="IdMarca" name="IdMarca">
                                @foreach ($marcas as $marca)
                                    <option value="{{$marca->IdMarca}}"  {{ $equipo->IdMarca == $marca->IdMarca ? "selected" : "" }}>{{$marca->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Modelo</label>
                            <select class="form-control" id="IdModelo" name="IdModelo">

                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Año de Adquisicion</label>
                            <input class="form-control" id="AnioAntiguedad" name="AnioAntiguedad" value="{{$tipo->AnioAntiguedad}}">
                        </div>
                    </div>
                    <div class="row kt-section">
                        <h3 class="kt-section__title col-lg-12">Datos de red y series</h3>
                        <div class="form-group col-lg-3">
                            <label>IP</label>
                            <input type="text" class="form-control" id="IP" name="IP" value="{{$equipo->IP}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Host</label>
                            <input type="text" class="form-control" id="Host" name="Host" value="{{$equipo->Host}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Codigo Patrimonial</label>
                            <input type="text" placeholder="74000000.0001" class="form-control" id="CodPatrimonial" name="CodPatrimonial" {{ $crtpdt == "Editar" ? "readonly='readonly'" : "" }} value="{{$equipo->CodPatrimonial}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Serie</label>
                            <input type="text" class="form-control" id="NumSerie" name="NumSerie" {{ $crtpdt == "Editar" ? "readonly='readonly'" : "" }} value="{{$equipo->NumSerie}}">
                        </div>
                    </div>

                    <div class="row kt-section">
                        <h3 class="kt-section__title col-lg-12">Hardware</h3>
                        <label class="col-lg-12"><b>Procesador</b></label>
                        <div class="form-group col-lg-3">
                            <label>Marca</label>
                            <input type="text" class="form-control" id="ProcMarca" name="ProcMarca" value="{{$equipo->ProcMarca}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Modelo</label>
                            <input type="text" class="form-control" id="Host" name="Host" value="{{$equipo->ProcModelo}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Serie</label>
                            <input type="text" class="form-control" id="Host" name="Host" value="{{$equipo->ProcModelo}}">
                        </div>
                    </div>

                    <div class="row kt-section">
                        <label class="col-lg-12"><b>Capacidad</b></label>
                        <div class="form-group col-lg-3">
                            <label>Memoria</label>
                            <input type="text" class="form-control" id="Memoria" name="Memoria" value="{{$equipo->Memoria}}">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Disco Duro</label>
                            <input type="text" class="form-control" id="DiscoDuro" name="DiscoDuro" value="{{$equipo->DiscoDuro}}">
                        </div>
                    </div>

                    <div class="row kt-section">
                        <h3 class="kt-section__title col-lg-12">Software</h3>
                        <div class="form-group col-lg-4">
                            <label style="width:100%">Sistema Operativo: </label>

                            <select  class="form-control col-lg-9" id="SistOperativo" name="SistOperativo">
                                @if ($equipo->SistOperativo)
                                    <option value="{{ $equipo->SistemaOperativo->IdSoftware }}">{{ $equipo->SistemaOperativo->Nombre }} {{ $equipo->SistemaOperativo->Version }}</option>
                                @else
                                    <option value="">SELECCIONAR</option>
                                @endif
                            </select>
                            <a onclick="agregarSO()"  class="btn btn-success btn-icon  col-lg-3"><i class="flaticon2-add-1"></i></a>
                        </div>

                        <div class="form-group col-lg-4">
                            <label style="width:100%">Antivirus: </label>
                            <select  class="form-control col-lg-9" id="Antivirus" name="Antivirus">
                                @if ($equipo->Antivirus)
                                    <option value="{{ $equipo->Antivirusav->IdSoftware }}">{{ $equipo->Antivirusav->Nombre }} {{ $equipo->Antivirusav->Version }}</option>
                                @else
                                    <option value="">SELECCIONAR</option>
                                @endif
                            </select>
                            <a onclick="agregarAV()"  class="btn btn-success btn-icon  col-lg-3"><i class="flaticon2-add-1"></i></a>
                        </div>

                        <div class="form-group col-lg-12">
                            <label style="width:100%">Programas Instalados: </label>
                            <select  class="form-control col-lg-11" multiple id="IdSoftware" name="IdSoftware[]">
                                @foreach ($equipo->Software as $item)
                                    <option selected="selected" value="{{ $item->IdSoftware }}">{{ $item->Nombre }} {{ $item->Version }}</option>
                                @endforeach
                            </select>
                            <a onclick="agregarPrograma()" class="btn btn-success btn-icon  col-lg-2"><i class="flaticon2-add-1"></i></a>
                        </div>
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
<div class="modal fade" id="modal_software" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

</div>

@endsection

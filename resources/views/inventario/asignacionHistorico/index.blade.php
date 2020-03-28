@extends('layout')
@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
.paginate_button {
    margin-left: .4rem !important;
}
.last,.first {
    background: #ebe9f2;

}
.paginate_button.current{
    background: #5d78ff;
    color: #fff;
}
.paginate_button.disabled{
    opacity: .6;
}

div.dataTables_pager>.dataTables_paginate *,.dataTables_paginate,.dataTables_pager  {
    display: flex !important;
}

.paginate_button:hover{
    background: #5d78ff;
    color: #fff;
}

.dataTables_pager,.dataTables_paginate {
    justify-content: space-between;
}
.paginate_button {
    color: #595d6e;
    border-radius: 3px;
    cursor: pointer;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    height: 2.25rem;
    min-width: 2.25rem;
    vertical-align: middle;
    padding: .5rem;
    text-align: center;
    position: relative;
    font-size: 1rem;
    line-height: 1rem;
    font-weight: 400;
    display: flex;
}
</style>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
    <script href="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}" rel="stylesheet" type="text/css" ></script>
    <script src="{{ asset('js/AsignacionHistorico.js')}}" type="text/javascript"></script>
    <script>
$(document).ready(function () {
    tabla_historico_asignacion("{{ route('inventario.asignacionhistorico.tabla') }}")
    cargarSAubtipo();
    CargarUsuarios();
    CargarResponsables();
    cargarModelos();
});
//CARGAR DATATABLE
$("#resetear").on("click", function(e) {
    $("#resetear").addClass(" disabled");
    document.getElementById('CodPatrimonial').value = "";
    document.getElementById('resDNI').value = "";
    document.getElementById('usuDNI').value = "";
    cargarSAubtipo();
    cargarModelos();
    $('#IdUsuario').val('').trigger('change');
    $('#IdResponsable').val('').trigger('change');

    tabla_historico_asignacion("{{ route('inventario.asignacionhistorico.tabla') }}")

})



 $("#buscar").on("click", function(a) {

                var IdTipo = document.getElementById('IdTipo').value;
                var IdSubTipo = document.getElementById('IdSubTipo').value;
                var IdMarca = document.getElementById('IdMarca').value;
                var IdModelo = document.getElementById('IdModelo').value;
                var CodPatrimonial = document.getElementById('CodPatrimonial').value;
                var resDNI = document.getElementById('resDNI').value;
                var IdResponsable = document.getElementById('IdResponsable').value;
                var usuDNI = document.getElementById('usuDNI').value;
                var IdUsuario = document.getElementById('IdUsuario').value;


                tabla_historico_asignacion("{{ route('inventario.asignacionhistorico.tabla') }}",IdTipo,IdSubTipo,IdMarca,IdModelo,CodPatrimonial,resDNI,IdResponsable,usuDNI,IdUsuario);
            })


 //CARGAR COMBO SUPTIPOS
 var cargarSAubtipo = () => {
                var tipo = document.getElementById('IdTipo');
                ajaxRequest(
                    "{{ route('inventario.modelo.subtipos') }}",
                    'POST',
                    {tipo : tipo.value},
                    function(response){
                        let SubTipos = ' <option value="">TODOS</option>'
                        for (var i=0; i<response.length;i++){
                            SubTipos+='<option value="'+response[i].IdSubTipo+'">'+response[i].Nombre+'</option>';
                        }
                        $("#IdSubTipo").html(SubTipos)
                        cargarModelos()
                });
            }
document.getElementById('IdTipo').addEventListener('change', (event) => {
    ajaxRequest(
        "{{ route('inventario.modelo.subtipos') }}",
        'POST',
        {tipo : event.target.value},
        function(response){
            let SubTipos = ' <option value="">TODOS</option>'
            for (var i=0; i<response.length;i++){
                SubTipos+='<option value="'+response[i].IdSubTipo+'">'+response[i].Nombre+'</option>';
            }
            $("#IdSubTipo").html(SubTipos)
            cargarModelos();
    });
});
//CARGAR COMBO MODELO
document.getElementById('IdMarca').addEventListener('change', (event) => {
    var tipo = document.getElementById('IdTipo');
    var subtipo = document.getElementById('IdSubTipo');
    var marca = document.getElementById('IdMarca');
    ajaxRequest(
        "{{ route('inventario.modelo.modelos') }}",
        'POST',
        {subtipo: subtipo.value,marca : marca.value,tipo: tipo.value},
        function(response){
            let modelo = ' <option value="">TODOS</option>'
            for (var i=0; i<response.length;i++){
                modelo+='<option value="'+response[i].IdModelo+'">'+response[i].Nombre+'</option>';
            }
            $("#IdModelo").html(modelo)
    });
});


var cargarModelos = () => {
        var tipo = document.getElementById('IdTipo');
        var subtipo = document.getElementById('IdSubTipo');
        var marca = document.getElementById('IdMarca');
        ajaxRequest(
            "{{ route('inventario.modelo.modelos') }}",
            'POST',
            {subtipo: subtipo.value,marca : marca.value,tipo: tipo.value},
            function(response){
                let modelo = ' <option value="">TODOS</option>'
                for (var i=0; i<response.length;i++){
                    modelo+='<option value="'+response[i].IdModelo+'">'+response[i].Nombre+'</option>';
                }
                $("#IdModelo").html(modelo)
        });
    }
//CARGAR COMBO USUARIO SELECT 2
var CargarUsuarios = () => {
            var url = "{{ route('inventario.asignacionhistorico.buscar_personal') }}";

            $("#IdUsuario").select2( {

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
                            param = {id:'',text:'TODOS'}
                            data.splice(0, 0, param);
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {results: data}
                        }
                    }
                }
            )
        }

//CARGAR COMBO RESPONSABLE SELECT 2
var CargarResponsables = () => {
            var url = "{{ route('inventario.asignacionhistorico.buscar_personal') }}";

            $("#IdResponsable").select2( {

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
                            param = {id:'',text:'TODOS'}
                            data.splice(0, 0, param);
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
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Historico de Asignaciones
                        <small></small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Exportar
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" id="exportar" name="exportar"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form kt-form--fit kt-margin-b-20">
                    <div class="row kt-margin-b-20">

                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            <label>Tipo: </label>
                            <select class="form-control kt-input" id="IdTipo" name="IdTipo" data-col-index="6">
                                <option value="">TODOS</option>
                                @foreach( $tipos as $tipo )
                                    <option value="{{ $tipo->IdTipo }}">{{ $tipo->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            <label>Subtipo: </label>
                            <select class="form-control kt-input" id="IdSubTipo" name="IdSubTipo" onchange="cargarModelos()" data-col-index="6">

                            </select>
                        </div>
                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            <label>Marca: </label>
                            <select class="form-control kt-input" id="IdMarca" name="IdMarca" data-col-index="6">
                                <option value="">TODOS</option>
                                @foreach( $marcas as $marca )
                                    <option value="{{ $marca->IdMarca }}">{{ $marca->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            <label>Modelo: </label>
                            <select class="form-control kt-input" id="IdModelo" name="IdModelo" data-col-index="6">
                            </select>
                        </div>
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            <label>Codigo Patrimonial: </label>
                            <input type="text" class="form-control kt-input" id="CodPatrimonial" name="CodPatrimonial" placeholder="" data-col-index="4">
                        </div>
                    </div>

                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Responsable DNI: </label>
                            <input type="text" class="form-control kt-input" id="resDNI" name="resDNI" placeholder="" data-col-index="4">
                        </div>

                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Responsable: </label>
                            <select class="js-example-data-ajax form-control" id="IdResponsable" name="IdResponsable" data-col-index="7">
                                <option value="">TODOS</option>
                            </select>
                        </div>
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Usuario DNI: </label>
                            <input type="text" class="form-control kt-input" id="usuDNI" name="usuDNI" placeholder="" data-col-index="4">
                        </div>

                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Usuario: </label>
                            <select class="js-example-data-ajax form-control" id="IdUsuario" name="IdUsuario"  data-col-index="7" >
                                <option value="">TODOS</option>
                            </select>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary btn-brand--icon" id="buscar" name="buscar" >
                                <span>
                                    <i class="la la-search"></i>
                                    <span>Buscar</span>
                                </span>
                            </a>
                           &nbsp;&nbsp;
                            <a class="btn btn-secondary btn-secondary--icon"  id="resetear" name="resetear" >
                                <span>
                                    <i class="la la-close"></i>
                                    <span>Reset </span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--md kt-separator--dashed"></div>
                </form>

            <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_historico" name="tabla_historico">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>SubTipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>CodPatrimonial</th>
                            <th>ResDNI</th>
                            <th>Responsable </th>
                            <th>UsuDNI</th>
                            <th>Usuario</th>
                            <th>FAsignacion</th>
                            <th>FDevolucion</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tipo</th>
                            <th>SubTipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>CodPatrimonial</th>
                            <th>ResDNI</th>
                            <th>Responsable </th>
                            <th>UsuDNI</th>
                            <th>Usuario</th>
                            <th>FAsignacion</th>
                            <th>FDevolucion</th>
                        </tr>
                    </tfoot>
                </table>

            <!--end: Datatable -->
            </div>
        </div>




        <!--begin: Modal crear marca-->
        <div class="modal fade" id="modal_agregar_subtipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal crear marca-->
        <!--begin: Modal crear marca-->
        <div class="modal fade" id="modal_editar_subtipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal crear marca-->
    </div>
</div>
@endsection

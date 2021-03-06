@extends('layout')
@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            tabla_modelos();
        });
        var tabla = $("#tabla_modelos").DataTable();
        var tabla_modelos =() =>  {
            ajaxRequest(
                "{{ route('inventario.modelo.tabla') }}",
                'GET',
                {},
                function(data){
                    tabla.destroy();
                    $("#tabla_modelos_body").html(data.html);
                    tabla = $("#tabla_modelos").DataTable({
                    language: datatable_es,
                    "columns": [
                        { "width": "5%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" }
                    ]
                    });
                    new $.fn.dataTable.Buttons( tabla, {
                        buttons: [
                            {
                            extend:    'copy',
                            text:      '<i class="kt-nav__link-icon la la-copy"></i> Copiar',
                            titleAttr: 'Copy',
                            className: 'dropdown-item',
                            title : "Modelos",
                            init: function(api, node, config) {
                                    $(node).removeClass('btn btn-secondary')
                                },
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            }
                            },
                            {
                            extend:    'csv',
                            text:      '<i class="kt-nav__link-icon la la-file-text-o"></i> CSV',
                            titleAttr: 'CSV',
                            className: 'dropdown-item',
                            title : "Modelos",
                            init: function(api, node, config) {
                                    $(node).removeClass('btn btn-secondary')
                                },
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            }
                            },
                            {
                            extend:    'excel',
                            text:      '<i class="kt-nav__link-icon la la-file-excel-o"></i> Excel',
                            titleAttr: 'Excel',
                            className: 'dropdown-item',
                            title : "Modelos",
                            init: function(api, node, config) {
                                    $(node).removeClass('btn btn-secondary')
                                },
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            }
                            },
                            {
                            extend:    'pdf',
                            text:      '<i class="kt-nav__link-icon la la-file-pdf-o"></i> PDF',
                            titleAttr: 'PDF',
                            className: 'dropdown-item',
                            title : "Modelos",
                            init: function(api, node, config) {
                                    $(node).removeClass('btn btn-secondary')
                                },
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            }
                            },
                            {
                            extend:    'print',
                            text:      '<i class="kt-nav__link-icon la la-print"></i> Imprimir',
                            titleAttr: 'Print',
                            className: 'dropdown-item',
                            title : "Modelos",
                            init: function(api, node, config) {
                                    $(node).removeClass('btn btn-secondary')
                                },
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4]
                            }
                            },
                        ]
                    } );
                    tabla.buttons().container().appendTo('#exportar');
                }
            );
        }
        var agregarModelo = () => {
            $.ajax({
                type:'get',
                url:"{{ route('inventario.modelo.create') }}",
                dataType: "json",
                data:{},
                success:function(data){
                    $("#modal_agregar_modelo").html(data.html);
                    $("#modal_agregar_modelo").modal('show');
                }
            });
        };

        $(document).on('click', '#btn_guardar_modelo', function(){
            var createForm = $("#ModeloForm").serializeArray();


            /*for (let i = 0; i < createForm.length; i++) {
                if (createForm[i].value == "") {
                    alert("se tiene que llenar todos los datos");
                    return true;
                }

            }*/
            ajaxRequest(
                    "{{ route('inventario.modelo.store') }}",
                    'POST',
                    createForm,
                    function(response){
                        tabla_modelos()
                        $("#modal_agregar_modelo").modal('hide');
                });
        })

        var EditarModelo = (id) => {
            $.ajax({
                type:'post',
                url:"{{ route('inventario.modelo.edit') }}",
                dataType: "json",
                data:{modelo : id},
                success:function(data){
                    $("#modal_editar_modelo").html(data.html);
                    tabla_modelos();
                    $("#modal_editar_modelo").modal('show');
                }
            });
        };

        $(document).on('click', '#btn_actualizar_modelo', function(){
            var url = "{{ route('inventario.modelo.update', ':id') }}";
    		url = url.replace(':id', $("#ModeloId").val());
            var createForm = $("#ModeloFormEdit");
            ajaxRequest(
	    		url,
	    		'PUT',
	    		createForm.serializeArray(),
	    		function(response){

                        if(response == 1){
                            tabla_modelos();
                            $("#modal_editar_modelo").modal('hide');
                        }else{
                            $("#modal_editar_modelo").modal('hide');
                        }
	    	});
        })

        var eliminarModelo = (id,nombre) => {
            swal.fire({
                title: "Seguro que desea eliminar?",
                text: "eliminar",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Si, Eliminar!"
            }).then((result) => {
                if (result.value) {
                        var url = "{{ route('inventario.modelo.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            type:'delete',
                            url:url,
                            dataType: "json",
                            data:{modelo : id},
                            success:function(data){
                            }
                    });
                    Swal.fire(
                    'Eliminado!',
                    'El Archivo a sido eliminado',
                    'success'
                    ).then((result) => {
                        if (result.value) {
                            tabla_modelos();
                        }
                    })
                }
            })
        };



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
                        Modelo
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
                &nbsp;
                <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" onclick="agregarModelo()">
                    <i class="la la-plus"></i>
                    Agregar Modelo
                </button>
            </div>
        </div>		 </div>
            </div>
            <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_modelos">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>SubTipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_modelos_body">
                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
        </div>




        <!--begin: Modal crear marca-->
        <div class="modal fade" id="modal_agregar_modelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal crear marca-->
        <!--begin: Modal editar marca-->
        <div class="modal fade" id="modal_editar_modelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal editar marca-->
    </div>
</div>
@endsection

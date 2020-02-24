@extends('layout')
@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            tabla_tipos();
        });
        var tabla = $("#tabla_tipos").DataTable();
        var tabla_tipos =() =>  {
            ajaxRequest(
                "{{ route('inventario.tipo.tabla') }}",
                'GET',
                {},
                function(data){
                    tabla.destroy();
                    $("#tabla_tipos_body").html(data.html);
                    tabla = $("#tabla_tipos").DataTable({
                    "columns": [
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" }
                    ]
                    });

                }
            );
        }
        var agregarTipo = () => {
            $.ajax({
                type:'get',
                url:"{{ route('inventario.tipo.create') }}",
                dataType: "json",
                data:{},
                success:function(data){
                    $("#modal_agregar_tipo").html(data.html);
                    tabla_tipos();
                    $("#modal_agregar_tipo").modal('show');
                }
            });
        };

        $(document).on('click', '#btn_guardar_tipo', function(){
            var createForm = $("#TipoForm");
            ajaxRequest(
                    "{{ route('inventario.tipo.store') }}",
                    'POST',
                    createForm.serializeArray(),
                    function(response){
                        tabla_tipos()
                        $("#modal_agregar_tipo").modal('hide');

                });
        })

        var EditarTipo = (id) => {
            $.ajax({
                type:'post',
                url:"{{ route('inventario.tipo.edit') }}",
                dataType: "json",
                data:{tipo : id},
                success:function(data){

                    $("#modal_editar_tipo").html(data.html);

                    $("#modal_editar_tipo").modal('show');
                }
            });
        };

        $(document).on('click', '#btn_actualizar_tipo', function(){
            var url = "{{ route('inventario.tipo.update', ':id') }}";
    		url = url.replace(':id', $("#IdTipo").val());
            var createForm = $("#TipoFormEdit");

            ajaxRequest(
	    		url,
	    		'PUT',
	    		createForm.serializeArray(),
	    		function(response){

                        if(response[0].UpdatedID){
                            tabla_tipos();
                            $("#modal_editar_tipo").modal('hide');
                        }
	    	});
        });

        var EliminarTipo = (id,nombre) => {
            swal.fire({
                title: "Seguro que desea eliminar?",
                text: `eliminar ${nombre}`,
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Si, Eliminar!"
            }).then((result) => {
                if (result.value) {
                        var url = "{{ route('inventario.tipo.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        ajaxRequest(
                            url,
                            'delete',
                            [],
                            function(response){
                                tabla_tipos();
                                Swal.fire(
                                'Eliminado!',
                                'El Archivo a sido eliminado',
                                'success'
                                );
                        });
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
                        Tipo
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
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__section kt-nav__section--first">
                                <span class="kt-nav__section-text">Choose an option </span>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-print"></i>
                                    <span class="kt-nav__link-text">Print </span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-copy"></i>
                                    <span class="kt-nav__link-text">Copy </span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                    <span class="kt-nav__link-text">Excel </span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                    <span class="kt-nav__link-text">CSV </span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                    <span class="kt-nav__link-text">PDF </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                &nbsp;
                <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" onclick="agregarTipo()">
                    <i class="la la-plus"></i>
                    Agregar Tipo
                </button>
            </div>
        </div>		 </div>
            </div>
            <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_tipos">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>Accion </th>
                    </tr>
                </thead>
                <tbody id="tabla_tipos_body">
                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
        </div>




        <!--begin: Modal crear marca-->
        <div class="modal fade" id="modal_agregar_tipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal crear marca-->
        <!--begin: Modal crear marca-->
        <div class="modal fade" id="modal_editar_tipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal crear marca-->
    </div>
</div>
@endsection

@extends('layout')
@section('style')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/custom/jstree/jstree.bundle.js')}}" type="text/javascript"></script>


    <script>
        $(document).ready(function () {
            tabla_personal();
        });
        var tabla = $("#tabla_personal").DataTable();

        //GENERA LA TABLA PERSONAL
        var tabla_personal =() =>  {
            ajaxRequest(
                "{{ route('generales.personal.tabla') }}",
                'GET',
                {},
                function(data){
                    tabla.destroy();
                    $("#tabla_personal_body").html(data.html);
                    tabla = $("#tabla_personal").DataTable({
                    "columns": [
                        { "width": "5%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" },
                        { "width": "20%" }
                    ]
                    });

                }
            );
        }



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

        var eliminarPersonal = (id,nombre) => {
            swal.fire({
                title: "Seguro que desea eliminar?",
                text: `Eliminar ${nombre}`,
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Si, Eliminar!"
            }).then((result) => {
                if (result.value) {
                        var url = "{{ route('generales.personal.destroy', ':id') }}";
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
                            tabla_personal();
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
                        Personal
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
                            <a href="{{ route('inventario.equipo.subtipo_create', ['subtipo' => $subtipo]) }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Agregar {{$subtipo}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('includes/flash-message')
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_personal">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>DNI</th>
                            <th>Nombres</th>
                            <th>Apellidos </th>
                            <th>Oficina </th>
                            <th>Accion </th>
                        </tr>
                    </thead>
                    <tbody id="tabla_personal_body">
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>




        <!--begin: Modal crear marca-->
        <div class="modal fade" id="modal_agregar_personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal crear marca-->
        <!--begin: Modal editar marca-->
        <div class="modal fade" id="modal_editar_personal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        </div>
        <!--end: Modal editar marca-->
    </div>
</div>
@endsection

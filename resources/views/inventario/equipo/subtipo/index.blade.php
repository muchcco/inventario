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
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.es.js')}}" charset="UTF-8" ></script>


    <script>
        $(document).ready(function () {
            tabla_equipo();
        });
        var tabla = $("#tabla_equipo").DataTable();

        //GENERA LA TABLA PERSONAL
        var tabla_equipo =() =>  {
            ajaxRequest(
                "{{ route('inventario.equipo.tabla') }}",
                'POST',
                {subtipo: "{{$subtipo}}"},
                function(data){
                    tabla.destroy();
                    $("#tabla_equipo_body").html(data.html);
                    tabla = $("#tabla_equipo").DataTable({
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

        var EliminarEquipo = (id) => {
            $.ajax({
                type:'post',
                url:"{{ route('inventario.equipo.subtipo_delete') }}",
                dataType: "json",
                data:{equipo : id},
                success:function(data){

                    $("#modal_equipo").html(data.html);

                    $("#modal_equipo").modal('show');
                }
            });
        };


        var DestroyEquipo = (id) => {
            var url = "{{ route('inventario.equipo.subtipo_destroy', ':id') }}";
    		url = url.replace(':id', id);
            $.ajax({
                type:'delete',
                url: url,
                dataType: "json",
                data:{equipo : id},
                success:function(data){
                    if(data == 1){
                        tabla_equipo();
                            $("#modal_equipo").modal('hide');
                            $("#modal_equipo").html("");
                        }

                }
            });

        };


        var QuitarAsignacion = (idAsignacion) => {
            $.ajax({
                type:'post',
                url:"{{ route('inventario.asignacion.desasignar') }}",
                dataType: "json",
                data:{asignacion : idAsignacion},
                success:function(data){

                    $("#modal_equipo").html(data.html);

                    $("#modal_equipo").modal('show');
                }
            });
        }

        var DesAsignado = () => {

            var FormDesasignar = $("#FormDesasignar").serializeArray();
            if (FormDesasignar[0]["value"]== "") {
                document.getElementById('valid_fasignacion').innerHTML = "Se debe seleccionar una fecha de devolución"
                return false;
            }
            ajaxRequest(
                    "{{ route('inventario.asignacion.desasignado') }}",
                    'POST',
                    FormDesasignar,
                    function(response){
                        if(response == 1){
                        tabla_equipo();
                            $("#modal_equipo").modal('hide');
                            $("#modal_equipo").html("");
                        }
                });
        }

        var ModalBaja = (IdEquipo) => {
            ajaxRequest(
                    "{{ route('inventario.equipo.modalbaja') }}",
                    'POST',
                    {IdEquipo : IdEquipo},
                    function(data){

                        $("#modal_equipo").html(data.html);
                        $("#modal_equipo").modal('show');

                });
        }

        var darBaja = () => {
            var FormBaja = $("#FormBaja").serializeArray();


            if (FormBaja[0]["value"]== "") {
                document.getElementById('valid_fbaja').innerHTML = "Se debe seleccionar una fecha"
                return false;
            }
            ajaxRequest(
                    "{{ route('inventario.equipo.baja') }}",
                    'POST',
                    FormBaja,
                    function(response){

                        if(response == 1){
                            tabla_equipo();
                            $("#modal_equipo").modal('hide');
                            $("#modal_equipo").html("");
                        }
                });
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
                        {{ $subtipo }}
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
                <table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_equipo">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cod. Patrimonial</th>
                            <th>Responsable</th>
                            <th>Usuario</th>
                            <th>Fecha Asignacion</th>
                            <th>Accion </th>
                        </tr>
                    </thead>
                    <tbody id="tabla_equipo_body">
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>

    </div>
</div>


    <!--begin: Modal Equipo-->
    <div class="modal fade" id="modal_equipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    </div>
    <!--end: Modal Equipo->

@endsection

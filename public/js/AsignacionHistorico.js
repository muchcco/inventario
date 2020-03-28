"use strict";
var tabla_historico_asignacion = (url,IdTipo = "",IdSubTipo= "", IdMarca= "",IdModelo= "",CodPatrimonial= "",resDNI= "",IdResponsable= "",usuDNI= "",IdUsuario= "") =>{

    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    var t;
    t = $("#tabla_historico").DataTable({
        destroy: true,
        responsive: !0,
        searching: false,
        dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
        lengthMenu: [ [5, 10, 20, -1], [5, 10, 20, "All"] ],
        keys: true,
        language: datatable_es,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        pagingType: "first_last_numbers",
        buttons: true,
        ajax: {

            url: url,
            type: "POST",
            data:{
                IdTipo: IdTipo,IdSubTipo: IdSubTipo,IdMarca: IdMarca,IdModelo: IdModelo,CodPatrimonial: CodPatrimonial,usuDNI: usuDNI,IdUsuario: IdUsuario, resDNI: resDNI,IdResponsable :IdResponsable
            }
        },

        columns: [{
                    data: "Tipo"
                }, {
                    data: "SubTipo"
                }, {
                    data: "Marca"
                }, {
                    data: "Modelo"
                }, {
                    data: "CodPatrimonial"
                }, {
                    data: "ResDNI"
                }, {
                    data: "Responsable"
                }, {
                    data: "UsuDNI"
                }, {
                    data: "Usuario"
                }, {
                    data: "FAsignacion"
                }, {
                    data: "FDevolucion"
                }
            ]
    });
    $('#tabla_historico_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
    //$('#tabla_historico_paginate').addClass('custom-select custom-select-sm form-tabla_historico_paginate-control-sm');
    var botones = new $.fn.dataTable.Buttons( t, {
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
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            }
            },
        ]
    } );
    t.buttons().container().appendTo('#exportar');
    $("#resetear").removeClass("disabled");


}

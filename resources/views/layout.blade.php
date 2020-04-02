<!DOCTYPE html>
 <!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
 <html lang="es">
     <!-- begin::Head -->
     <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Original URL: https://keenthemes.com/metronic/preview/demo1/
        Date Downloaded: 11/12/2019 15:20:00 !-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <meta charset="utf-8" />

         <title>Metronic | Dashboard </title>
         <meta name="description" content="Updates and statistics" />
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

         <!--begin::Fonts -->
         <link rel="stylesheet" href="{{ asset('assets/fonts.googleapis.com/css_ee6ab223.css')}}" />         <!--end::Fonts -->




        <!--begin::Global Theme Styles(used by all pages) -->
            <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Layout Skins -->
        <!--Begin::style-->
        @yield('style')
        <!--End::style-->
         <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
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
         <!-- Hotjar Tracking Code for keenthemes.com -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async="" src="{{ asset('assets/www.googletagmanager.com/gtag/js_d0953377.js')}}"></script>
</head>
     <!-- end::Head -->
     <?php

     function setActive($ruteName){

       return request()->is($ruteName) ? 'kt-menu__item--active': '';
     }
    ?>
<!-- begin::Body -->
<body style="" class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed" style="">
    <!-- begin:: Page -->
<!-- begin:: Header Mobile -->

<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <img alt="Logo"  style="padding: 20px;display: block;height: 77px;" src="{{ asset('assets/media/logos/logo-INIA-horizontal.png')}}" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
            id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

<!-- begin:: Aside -->
@include('includes/sidebar')
<!-- end:: Aside -->


        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                <!-- begin:: Header Menu -->
                <!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->

                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

                    <div id="kt_header_menu"
                        class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--"
                                data-ktmenu-submenu-toggle="click" aria-haspopup="true">

                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel"
                                data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel"
                                data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end:: Header Menu -->
                <!-- begin:: Header Topbar -->
                <div class="kt-header__topbar">
                    <!--begin: User Bar -->
                    @include('includes/head')
                    <!--end: User Bar -->
                </div>
                <!-- end:: Header Topbar -->
            </div>
            <!-- end:: Header -->
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content Head -->
                @include('includes/content_head')
                <!-- end:: Content Head -->
                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    <!--Begin::content-->
                    @yield('content')
                    <!--End::content-->
                </div>
                <!-- end:: Content -->
            </div>

            <!-- begin:: Footer -->
            @include('includes/footer')
            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->





<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->
     <!--ENd:: Chat-->

         <!-- begin::Global Config(global config for global JS sciprts) -->
         <script>
            var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "dark": "#282a3c",
            "light": "#ffffff",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};
        </script>
         <!-- end::Global Config -->

    	 <!--begin::Global Theme Bundle(used by all pages)-->
                    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}" type="text/javascript"></script>

		    	    <script src="{{ asset('assets/js/scripts.bundle.js')}}" type="text/javascript"></script>
                <!--end::Global Theme Bundle -->
                    <script src="{{ asset('assets/highchart/code/highcharts.js')}}"></script>
                    <!--Begin::style-->
                        @yield('script')
                    <!--End::style-->
                    <script>
                    function ajaxRequest(url, type, data, successFunction){
                        $.ajax({
                            url: url,
                            method: type,
                            data: data,
                            success: successFunction
                        });
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var datatable_es = {
                                        "sProcessing":     "Procesando...",
                                        "sLengthMenu":     "Mostrar _MENU_ registros",
                                        "sZeroRecords":    "No se encontraron resultados",
                                        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                                        "sInfoPostFix":    "",
                                        "sSearch":         "Buscar:",
                                        "sUrl":            "",
                                        "sInfoThousands":  ",",
                                        "sLoadingRecords": "Cargando...",
                                        "oPaginate": {
                                            "sFirst":    "Primero",
                                            "sLast":     "Último",
                                            "sNext":     "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "oAria": {
                                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                        },
                                        "buttons": {
                                            "copy": "Copiar",
                                            "colvis": "Visibilidad"
                                        }
                                    }

                        Highcharts.setOptions({
                            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
                            lang: {
                                loading: 'Cargando...',
                                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                                shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                                exportButtonTitle: "Exportar",
                                printButtonTitle: "Importar",
                                rangeSelectorFrom: "Desde",
                                rangeSelectorTo: "Hasta",
                                rangeSelectorZoom: "Período",
                                downloadPNG: 'Descargar imagen PNG',
                                downloadJPEG: 'Descargar imagen JPEG',
                                downloadPDF: 'Descargar imagen PDF',
                                downloadSVG: 'Descargar imagen SVG',
                                downloadCSV: 'Descargar CSV',
                                downloadXLS: 'Descargar XLS',
                                viewData: 'Ver datos',
                                viewFullscreen: 'Ver en pantalla completa',
                                printChart: 'Imprimir',
                                resetZoom: 'Reiniciar zoom',
                                resetZoomTitle: 'Reiniciar zoom',
                                thousandsSep: ",",
                                decimalPoint: '.'
                            } ,
                            credits: false,
                            chart: {
                                style: {
                                    fontFamily: 'Poppins,Helvetica,sans-serif'
                                }
                            }
                        });
        </script>
    </body>
     <!-- end::Body -->
 </html>
<

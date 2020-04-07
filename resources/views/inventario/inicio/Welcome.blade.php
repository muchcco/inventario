@extends('layout')
@section('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/amcharts/lib/3/plugins/export/export.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js')}}" type="text/javascript"></script>


    <script src="{{ asset('assets/highchart/code/modules/exporting.js')}}"></script>
    <script src="{{ asset('assets/highchart/code/modules/export-data.js')}}"></script>
    <script src="{{ asset('assets/highchart/code/modules/accessibility.js')}}"></script>


    <script src="{{ asset('assets/amcharts/lib/3/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/serial.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/radar.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/pie.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/plugins/tools/polarScatter/polarScatter.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/plugins/animate/animate.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/plugins/export/export.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/amcharts/lib/3/themes/light.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/welcome.js')}}"   ></script>
    <script type="text/javascript">
        var miFuncion = () => {

            equiposPorOrganosDesconcentrados("{{ route('graficos.equiposPorOrganosDesconcentrados') }}");
            equiposPorTipo("{{ route('graficos.equiposPorTipo') }}");
        };
        window.onload=miFuncion;
    </script>
@endsection

@section('content')
<div class="row">
    <!--begin:: Widgets/Stats-->
 <div class="kt-portlet">
    <div class="kt-portlet__body  kt-portlet__body--fit">
        <div class="row row-no-padding row-col-separator-lg">

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                               {{ $datas[0]->SubTipo }}
                            </h4>
                            <span class="kt-widget24__desc">
                               Desktop
                            </span>
                        </div>

                        <span class="kt-widget24__stats kt-font-brand">
                            {{ $datas[0]->Cantidad }}
                        </span>
                    </div>

                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: {{ $datas[0]->porcentaje }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="kt-widget24__action">
                        <span class="kt-widget24__change">
                           Utilizados
                        </span>
                        <span class="kt-widget24__number">
                            {{ $datas[0]->Utilizado }}
                        </span>
                    </div>
                </div>
                <!--end::Total Profit-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Feedbacks-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                {{ $datas[1]->SubTipo }}
                            </h4>
                            <span class="kt-widget24__desc">
                                Desktop
                            </span>
                        </div>

                        <span class="kt-widget24__stats kt-font-warning">
                            {{ $datas[1]->Cantidad }}
                        </span>
                    </div>

                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-warning" role="progressbar" style="width: {{ $datas[1]->porcentaje }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="kt-widget24__action">
                        <span class="kt-widget24__change">
                            Utilizados
                        </span>
                        <span class="kt-widget24__number">
                            {{ $datas[1]->Utilizado }}
                        </span>
                    </div>
                </div>
                <!--end::New Feedbacks-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Orders-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                {{ $datas[2]->SubTipo }}
                            </h4>
                            <span class="kt-widget24__desc">
                                Desktop
                            </span>
                        </div>

                        <span class="kt-widget24__stats kt-font-danger">
                            {{ $datas[2]->Cantidad }}
                        </span>
                    </div>

                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-danger" role="progressbar" style="width: {{ $datas[2]->porcentaje }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="kt-widget24__action">
                        <span class="kt-widget24__change">
                            Utilizados
                        </span>
                        <span class="kt-widget24__number">
                            {{ $datas[2]->Utilizado }}
                        </span>
                    </div>
                </div>
                <!--end::New Orders-->
            </div>

            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Users-->
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                {{ $datas[3]->SubTipo }}
                            </h4>
                            <span class="kt-widget24__desc">
                                Desktop
                            </span>
                        </div>

                        <span class="kt-widget24__stats kt-font-success">
                            {{ $datas[3]->Cantidad }}
                        </span>
                    </div>

                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $datas[3]->porcentaje }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="kt-widget24__action">
                        <span class="kt-widget24__change">
                            Utilizados
                        </span>
                        <span class="kt-widget24__number">
                            {{ $datas[3]->Utilizado }}
                        </span>
                    </div>
                </div>
                <!--end::New Users-->
            </div>

        </div>
    </div>
</div>
<!--end:: Widgets/Stats-->
    <div class="col-xl-12 col-lg-12 order-lg-12 order-xl-12">
        <!--begin:: Widgets/Daily Sales-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14" >
                <div class="kt-widget14__header kt-margin-b-30">
                </div>
                <div class="kt-widget14__chart col-lg-12" id="equiposPorOrganosDesconcentrados">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 order-lg-12 order-xl-12">
        <!--begin:: Widgets/Daily Sales-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14" >
                <div class="kt-widget14__header kt-margin-b-30">
                </div>
                <div class="kt-widget14__chart" style="width: 100%" id="equiposPorTipo">
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .chart-outer {
    max-width: 800px;
    margin: 2em auto;
}
#container {
    height: 300px;
    margin-top: 2em;
    min-width: 380px;
}
.highcharts-data-table table {
    border-collapse: collapse;
    border-spacing: 0;
    background: white;
    min-width: 100%;
    margin-top: 10px;
    font-family: sans-serif;
    font-size: 0.9em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    border: 1px solid silver;
    padding: 0.5em;
}
.highcharts-data-table tr:nth-child(even), .highcharts-data-table thead tr {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #eff;
}
.highcharts-data-table caption {
    border-bottom: none;
    font-size: 1.1em;
    font-weight: bold;
}
caption {
    padding-top: .75rem;
    padding-bottom: .75rem;
    color: #74788d;
    text-align: center;
    caption-side: top;
}
</style>
@endsection

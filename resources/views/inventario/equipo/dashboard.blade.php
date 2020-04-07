
@foreach( $tipos as $tipo )
<div class="col-lg-1 col-xl-3 order-lg-1 order-xl-1">
    <!--begin:: Widgets/Activity-->
    <div
        class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{$tipo->Nombre}}
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body kt-portlet__body--fit" style="background: #e4eee4;">
            <div class="kt-widget17">
                <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides"
                    style="background-color: #3a9c25">
                    <div class="kt-widget17__chart" style="height:150px;">

                    </div>
                </div>


                    <div class="kt-widget17__stats">
                            @foreach( $tipo->hijos as $subtipo )
                            <a href="{{ route('inventario.equipo.subtipo', ['subtipo' => $subtipo->Nombre]) }}">
                                <div class="kt-widget17__items">
                                    <div class="kt-widget17__item">
                                        <span class="kt-widget17__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                height="24px" viewbox="0 0 24 24" version="1.1"
                                                class="kt-svg-icon kt-svg-icon--brand">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path
                                                        d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                        fill="#000000"></path>
                                                    <rect fill="#000000" opacity="0.3"
                                                        transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "
                                                        x="16.3255682" y="2.94551858" width="3"
                                                        height="18" rx="1"></rect>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="kt-widget17__subtitle">
                                            {{$subtipo->Nombre}}
                                        </span>
                                        <span class="kt-widget17__desc">
                                            Cantidad de Equipos: {{$subtipo->equipos}}<br>
                                            Cantidad de Equipos sin asignar: {{$subtipo->noasignados}}

                                        </span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                    </div>

            </div>
        </div>
    </div>
    <!--end:: Widgets/Activity-->
</div>
<br><br><br>

@endforeach

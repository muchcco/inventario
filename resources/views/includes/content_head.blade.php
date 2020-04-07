<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">



            <span class="kt-subheader__separator kt-subheader__separator--v"></span>

            <a href="#" class="btn btn-label-success btn-bold btn-sm btn-icon-h kt-margin-l-10">
                DEPENDENCIA: {{ Auth::user()->dependencias->Nombre }}
            </a>

            <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                <input type="text" class="form-control" placeholder="Search order..."
                    id="generalSearch" />
                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                    <span><i class="flaticon2-search-1"></i></span>
                </span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">

                <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker"
                    data-toggle="kt-tooltip" data-placement="left">
                    <span class="kt-subheader__btn-daterange-title"
                        id="kt_dashboard_daterangepicker_title">Hoy </span>&nbsp;
                    <span class="kt-subheader__btn-daterange-date"
                        id="kt_dashboard_daterangepicker_date"><?php  echo date("d M Y");?> </span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->

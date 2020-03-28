
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Dar de Baja</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form action="post" id="FormBaja" name="FormBaja">
                <div class="kt-widget13">
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Tipo
                        </span>
                        <span class="kt-widget13__text kt-font-brand">
                            {{ $equipo->Tipo }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            SubTipo
                        </span>
                        <span class="kt-widget13__text kt-font-brand">
                            {{ $equipo->SubTipo }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Marca
                        </span>
                        <span class="kt-widget13__text kt-font-brand">
                            {{ $equipo->Marca }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Modelo
                        </span>
                        <span class="kt-widget13__text kt-font-brand">
                            {{ $equipo->Modelo }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Codigo patrimonial
                        </span>
                        <span class="kt-widget13__text kt-font-brand">
                            {{ $equipo->CodPatrimonial }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Numero de serie
                        </span>
                        <span class="kt-widget13__text kt-font-brand">
                            {{ $equipo->NumSerie }}
                        </span>
                    </div>
                    <div class="kt-widget13 validated">
                        <div class="kt-widget13__item">
                            <span class="kt-widget13__desc">
                                Fecha de Baja
                            </span>
                            <span class="kt-widget13__text kt-font-brand">
                            <input type="text"  class="form-control" id="FBaja" name="FBaja" readonly="" autocomplete="off" placeholder="Seleccionar Fecha" />
                            </span>
                        </div>
                        <div class="invalid-feedback" id="valid_fbaja" name="valid_fbaja"></div>
                    </div>
                </div>
                <input type="hidden" name="IdEquipo" id="IdEquipo" value="{{$equipo->IdEquipo}}">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <a href="#" class="btn btn-primary" onclick='darBaja()'>Dar de Baja</a>
        </div>
    </div>
</div>


<script>
    $("#FBaja").datepicker( {
                    language:"es",
                    todayHighlight: !0,
                    format: "dd/mm/yyyy",
                    todayHighlight: !0,
                    format: "dd/mm/yyyy",
                    orientation: "bottom left"
                }
                ).on('changeDate', function(e) {
                    document.getElementById('valid_fbaja').innerHTML = "";
                });

    </script>

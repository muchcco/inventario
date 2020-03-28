

<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Quitar Asignacion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form action="post" id="FormDesasignar" name="FormDesasignar">
            <div class="kt-widget13">
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        Responsable
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                        {{ $asignado->RespNombre }} {{ $asignado->RespApePat }} {{ $asignado->RespApeMat }}
                    </span>
                </div>
            </div>
            <div class="kt-widget13">
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        Usuario
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                        {{ $asignado->UsuNombre }} {{ $asignado->UsuApePat }} {{ $asignado->UsuApeMat }}
                    </span>
                </div>
            </div>
            <div class="kt-widget13">
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        Fecha de Asignación
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                        {{ date('d/m/Y', strtotime($asignado->FAsignacion)) }}
                    </span>
                </div>
            </div>
            <div class="kt-widget13 validated">
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        Fecha de Devolución
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                    <input type="text"  class="form-control" id="FDevolucion" name="FDevolucion" readonly="" autocomplete="off" placeholder="Seleccionar Fecha" />
                    </span>
                </div>
                <div class="invalid-feedback" id="valid_fasignacion" name="valid_fasignacion"></div>
            </div>
            <input type="hidden" name="IdAsignacion" id="IdAsignacion" value="{{ $asignado->IdAsignacion }}">
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <a href="#" class="btn btn-primary" onclick="DesAsignado()">Guardar</a>
        </div>
    </div>
</div>
<script>
$("#FDevolucion").datepicker( {
                language:"es",
                todayHighlight: !0,
                format: "dd/mm/yyyy",
                todayHighlight: !0,
                format: "dd/mm/yyyy",
                orientation: "bottom left",
                startDate: "{{ date('d/m/Y', strtotime($asignado->FAsignacion)) }}"
            }
            ).on('changeDate', function(e) {
                document.getElementById('valid_fasignacion').innerHTML = "";
            });

</script>

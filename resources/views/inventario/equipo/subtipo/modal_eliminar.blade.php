
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Equipo y Asignacion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
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
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        Responsable
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                        {{ $equipo->Responsable }}
                    </span>
                </div>
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        Usuario
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                        {{ $equipo->Usuario }}
                    </span>
                </div>
                <div class="kt-widget13__item">
                    <span class="kt-widget13__desc">
                        FAsignacion
                    </span>
                    <span class="kt-widget13__text kt-font-brand">
                        @if ($equipo->FAsignacion != "")
                            {{ date('d/M/Y', strtotime($equipo->FAsignacion)) }}
                        @endif
                    </span>
                </div>
             </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar </button>
            <a href="#" class="btn btn-primary" onclick='DestroyEquipo("{{$equipo->IdEquipo}}")'>Eliminar</a>
        </div>
    </div>
</div>





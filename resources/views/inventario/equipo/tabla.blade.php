{{ $i = 1 }}
@foreach( $equipos as $equipo )
<tr>
    <td> {{ $i }} </td>
    <td> {{ $equipo->CodPatrimonial }} </td>
    <td> {{ $equipo->Responsable }} </td>
    <td> {{ $equipo->Usuario }} </td>
    <td>
        @if ($equipo->FAsignacion != "")
            {{  $equipo->FAsignacion }}
        @endif
    </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Asignacion
            </button>
            <div class="dropdown-menu">

                @if ( $equipo->Responsable == "" && $equipo->Usuario == "")
                    <a class="dropdown-item" href="{{route('inventario.asignacion.create', ['Equipo' => $equipo->IdEquipo])}}">Asignar</a>
                @else
                    <a href="#" class="dropdown-item" onclick='QuitarAsignacion("{{$equipo->IdAsignacion}}")'>Quitar Asignación</a>
                    <a class="dropdown-item" href="{{route('inventario.asignacion.reasignar', ['asignacion' => $equipo->IdAsignacion])}}">Reasignar</a>
                @endif
                <div class="dropdown-divider"></div>
                @if ( $equipo->Responsable == "" && $equipo->Usuario == "")
                    <a class="dropdown-item" href="#" onclick="ModalBaja('{{$equipo->IdEquipo}}')">Dar de baja</a>
                @endif
            </div>
        </div>
        <div class="dropdown dropdown-inline" style="float: right;">
            <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="flaticon-more"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" style="">
                <a class="dropdown-item" href="{{route('inventario.equipo.subtipo_edit', ['Equipo' => $equipo->IdEquipo,'subtipo'=> $subtipo])}}"><i class="flaticon-edit-1"></i>Editar</a>
                <a class="dropdown-item" href="#"  onclick='EliminarEquipo("{{$equipo->IdEquipo}}")'><i class="flaticon-delete"></i>Eliminar</a>
            </div>
        </div>

</tr>
{{ $i++ }}
@endforeach

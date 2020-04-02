


    @foreach( $personal as $persona )
        <tr>
            <td> {{ $persona->IdPersonal }} </td>
            <td> {{ $persona->DNI }} </td>
            <td> {{ $persona->NomPersonal }} </td>
            <td> {{ $persona->ApePat }} {{ $persona->ApeMat }}</td>
            <td> {{ $persona->Codigo }} </td>

            <td><a style="color: #fff" class="btn btn-success btn-font-sm" href="{{route('generales.personal.edit', ['personal' => $persona->IdPersonal])}}"><b>EDITAR</b> </a>
                @if ( Auth::user()->role->nombre == "Administrador" )
                <button type="button" class="btn btn-danger btn-font-sm" id="btn_eliminar_modelo" name="btn_eliminar_modelo" onclick="eliminarPersonal({{ $persona->IdPersonal }},'{{ $persona->NomPersonal }}')" ><b>ELIMINAR</b> </button>
                @endif
            </td>
        </tr>
    @endforeach


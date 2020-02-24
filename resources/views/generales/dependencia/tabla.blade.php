


    @foreach( $modelos as $modelo )
        <tr>
            <td> {{ $modelo->IdModelo }} </td>
            <td> {{ $modelo->TipoNombre }} </td>
            <td> {{ $modelo->SubTipoNombre }} </td>
            <td> {{ $modelo->MarcaNombre }} </td>
            <td> {{ $modelo->ModeloNombre }} </td>

            <td><button type="button" class="btn btn-success btn-font-sm" onclick="EditarModelo({{$modelo->IdModelo}})"><b>EDITAR</b> </button>
                <button type="button" class="btn btn-danger btn-font-sm" id="btn_eliminar_modelo" name="btn_eliminar_modelo" onclick="eliminarModelo({{ $modelo->IdModelo }},'{{ $modelo->ModeloNombre }}')" ><b>ELIMINAR</b> </button>
            </td>
        </tr>
    @endforeach


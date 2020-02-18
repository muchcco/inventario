


    @foreach( $modelos as $modelo )
        <tr>
            <td> {{ $modelo->id }} </td>
            <td> {{ $modelo->nombremarca }} </td>
            <td> {{ $modelo->nombremodelo }} </td>

            <td><button type="button" class="btn btn-success btn-font-sm" onclick="EditarModelo({{$modelo->id}})"><b>EDITAR</b> </button>
                <button type="button" class="btn btn-danger btn-font-sm" id="btn_eliminar_modelo" name="btn_eliminar_modelo" onclick="eliminarModelo({{ $modelo->id }},'{{ $modelo->nombremodelo }}')" ><b>ELIMINAR</b> </button>
            </td>
        </tr>
    @endforeach


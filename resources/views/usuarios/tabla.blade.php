
    @foreach( $usuarios as $usuario )
    <tr>
        <td> {{ $usuario->idu }} </td>
        <td> {{ $usuario->un }} </td>
        <td> {{ $usuario->rn }} </td>

        <td><button type="button" class="btn btn-success btn-font-sm" onclick="EditarMarca({{$usuario->idu}})"><b>EDITAR</b> </button>
            <button type="button" class="btn btn-danger btn-font-sm" id="btn_eliminar_modelo" name="btn_eliminar_modelo" onclick="eliminarModelo({{ $usuario->idu }},'{{ $usuario->nombremodelo }}')" ><b>ELIMINAR</b> </button>
        </td>
    </tr>
@endforeach


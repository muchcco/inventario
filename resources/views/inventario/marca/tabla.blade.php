


    @foreach( $modelos as $modelo )
        <tr>
            <td> {{ $modelo->IdMarca }} </td>
            <td> {{ $modelo->Nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarMarca({{$modelo->IdMarca}})">Editar </button>
            <button type="button" class="btn btn-danger" onclick="EliminarMarca({{$modelo->IdMarca}},'{{$modelo->Nombre}}')">Eliminar </button></td>
        </tr>
    @endforeach


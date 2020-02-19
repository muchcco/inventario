


    @foreach( $tipos as $tipo )
        <tr>
            <td> {{ $tipo->IdTipo }} </td>
            <td> {{ $tipo->Nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarTipo({{$tipo->IdTipo}})">Editar </button>
                <button type="button" class="btn btn-danger" onclick="EliminarTipo({{$tipo->IdTipo}},'{{ $tipo->Nombre }}')">Eliminar </button></td>
        </tr>
    @endforeach


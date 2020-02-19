


    @foreach( $subtipos as $subtipo )
        <tr>
            <td> {{ $subtipo->TipoNom }} </td>
            <td> {{ $subtipo->IdTipo }} </td>
            <td> {{ $subtipo->Nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarTipo({{$subtipo->IdTipo}})">Editar </button>
                <button type="button" class="btn btn-danger" onclick="EliminarTipo({{$subtipo->IdTipo}},'{{ $subtipo->Nombre }}')">Eliminar </button></td>
        </tr>
    @endforeach


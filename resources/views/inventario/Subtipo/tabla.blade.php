


    @foreach( $subtipos as $subtipo )
        <tr>
            <td> {{ $subtipo->IdSubTipo }} </td>
            <td> {{ $subtipo->TipoNom }} </td>
            <td> {{ $subtipo->Nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarTipo({{$subtipo->IdSubTipo}})">Editar </button>
                <button type="button" class="btn btn-danger" onclick="EliminarTipo({{$subtipo->IdSubTipo}},'{{ $subtipo->Nombre }}')">Eliminar </button></td>
        </tr>
    @endforeach


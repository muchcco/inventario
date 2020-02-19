


    @foreach( $tipos as $tipo )
        <tr>
            <td> {{ $tipo->IdTipo }} </td>
            <td> {{ $tipo->Nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarTipo({{$tipo->IdTipo}})">Editar </button>

        </tr>
    @endforeach


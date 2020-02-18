


    @foreach( $tipos as $tipo )
        <tr>
            <td> {{ $tipo->id }} </td>
            <td> {{ $tipo->nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarTipo({{$tipo->id}})">Editar </button>

        </tr>
    @endforeach


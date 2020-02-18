


    @foreach( $modelos as $modelo )
        <tr>
            <td> {{ $modelo->id }} </td>
            <td> {{ $modelo->nombre }} </td>

            <td><button type="button" class="btn btn-success" onclick="EditarMarca({{$modelo->id}})">Editar </button>

        </tr>
    @endforeach


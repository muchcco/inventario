
    @foreach( $equipos as $equipo )
    <tr>
        <td> {{ $equipo->IdEquipo }} </td>
        <td> {{ $equipo->NomMarca }} </td>
        <td> {{ $equipo->CodPatrimonial }} </td>
        <td> {{ $equipo->FFabricacion }} </td>
        <td> {{ $equipo->Perfil }} </td>
        <td> {{ $equipo->Host }} </td>
        <td> {{ $equipo->IP }} </td>
        <td> {{ $equipo->NumSerie }} </td>

        <td>Boton</td>
    </tr>
@endforeach
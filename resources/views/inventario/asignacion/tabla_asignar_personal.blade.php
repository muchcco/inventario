


    @foreach( $results as $result )
        <tr>
            <td> {{ $result->DNI }} </td>
            <td> {{ $result->NomPersonal }} {{$result->ApePat}} {{$result->ApeMat}} </td>
            <td> {{ $result->Dependencia }} </td>
            <td><button type="button" class="btn btn-brand" onclick="AsignarPersonal('{{$tipo}}','{{ $result->IdPersonal }}','{{ $result->DNI }}','{{ $result->NomPersonal }} {{$result->ApePat}} {{$result->ApeMat}}','{{ $result->Dependencia }}')">Asignar </button></td>

        </tr>
    @endforeach



<div class="form-group row">
    <div class="col-lg-3">
        <div class="input-group">
            <input type="text" class="form-control" name="parametro_modal" id="parametro_modal" onkeyup="javascript:this.value=this.value.toUpperCase();">

            <div class="input-group-append">
                <a class="btn btn-success "  onclick="BuscarPersonal('{{$tipo}}','_modal')" name="buscar" id="buscar"  style="color: #fff">Buscar</a>
            </div>
        </div>
    </div>
    <div class="offset-md-7 col-md-2">
        <a class="btn btn-success "  name="buscar" id="buscar" onclick="CrearPersonal('{{$tipo}}')"  style="color: #fff">Agregar</a>
    </div>
</div>
<table class="table table-striped- table-bordered table-hover table-checkable" id="tabla_asignar_personal">
    <thead>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Dependencia</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody id="">
        @foreach( $results as $result )
        <tr>
            <td> {{ $result->DNI }} </td>
            <td> {{ $result->NomPersonal }} {{$result->ApePat}} {{$result->ApeMat}} </td>
            <td> {{ $result->Dependencia }} </td>
            <td><button type="button" class="btn btn-brand" onclick="AsignarPersonal('{{$tipo}}','{{ $result->IdPersonal }}','{{ $result->DNI }}','{{ $result->NomPersonal }} {{$result->ApePat}} {{$result->ApeMat}}','{{ $result->Dependencia }}')">Asignar </button></td>

        </tr>
    @endforeach

    </tbody>
</table>



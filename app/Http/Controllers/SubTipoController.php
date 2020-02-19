<?php

namespace App\Http\Controllers;

use App\SubTipo;
use App\Tipo;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SubTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventario.subtipo.index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla()
    {
        $Tipo=Tipo::find(2);




        return $Tipo->SubTipos()->toArray();
       // $modelos = Marca::join('modelos','modelos.id_marca','=','marcas.id')->select('modelos.nombre as nombremod'  , 'modelos.id', 'marcas.nombre')->get();
        $modelos = SubTipo::join('Tipo','Tipo.id_marca','=','marcas.id')->select('modelos.nombre as nombremod'  , 'modelos.id', 'marcas.nombre')->get();


        $view = view('inventario.tipo.tabla',compact('tipos'))->render();
        return response()->json(['html'=>$view]);
    }
}

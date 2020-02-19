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

        $subtipos = SubTipo::join('Tipo','Tipo.idTipo','=','SubTipo.IdSubTipo')->select('Tipo.nombre as TipoNom'  , 'SubTipo.IdSubTipo', 'SubTipo.Nombre')->get();


        $view = view('inventario.subtipo.tabla',compact('subtipos'))->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view_create =  view('inventario.subtipo.create')->render();
        return response()->json(['html'=>$view_create]);
    }
}

<?php

namespace App\Http\Controllers;

Use App\Equipo;
use App\Marca;
use App\SubTipo;
use App\Tipo;
use Carbon\carbon;
//use Request;

use Validator;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('inventario.equipo.index');
    }

    public function listar()
    {
        return view('inventario.equipo.listar');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personal = Tipo::join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia');

        return view('inventario.equipo.create');
    }

    public function tabla()
    {
        $tipos = Tipo::get();

        for ($i=0; $i < count($tipos); $i++) {
            $subtipo = SubTipo::where('IdTipo', $tipos[$i]->IdTipo)->get();
            $tipos[$i]["hijos"] = $subtipo;
        }


        $view = view('inventario.equipo.tabla',compact('tipos'))->render();
        return response()->json(['html'=>$view]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subtipo($subtipo)
    {
        return view('inventario.equipo.subtipo.'.$subtipo.'.index',compact('subtipo'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subtipo_create($subtipo,Request $request)
    {
        $crtpdt = "Nuevo";
        $subt = SubTipo::where('Nombre',$subtipo)->first();
        $tipo = Tipo::where('IdTipo',$subt->IdTipo)->first();
        $marcas = Marca::get();
        $equipo = new Equipo;
        $equipo->IdEquipo = 0;
        $equipo->Host = gethostname();
        $equipo->IP = gethostbyname($equipo->Host);
        $view_create =  view('inventario.equipo.subtipo.'.$subtipo.'.create',compact('equipo','subt','tipo','crtpdt','marcas'));
        return $view_create;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subtipo_store(Request $request)
    {

        $attr = $request->all();

        $tipo = Tipo::where('Nombre',$attr["NomTipo"])->first();
        $attr["IdTipo"] = $tipo->IdTipo;
        $subtipo = SubTipo::where('Nombre',$attr["NomSubTipo"])->first();
        $attr["IdSubTipo"] = $subtipo->IdSubTipo;
        $marca = Marca::where('IdMarca',$attr["IdMarca"])->first();
        $attr["NomMarca"] = $marca->Nombre;

        $equipo = Equipo::create($attr);

        return redirect()->route('inventario.asignacion.create',['Equipo' => $equipo["IdEquipo"]]);


    }
}

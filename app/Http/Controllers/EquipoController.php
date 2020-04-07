<?php

namespace App\Http\Controllers;

Use App\Equipo;
use App\Marca;
use App\SubTipo;
use App\Tipo;
use App\Asignacion;
use App\Modelo;
use App\User;
use App\Personal;
use Carbon\carbon;
//use Request;

use Validator;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function __construct()
    {

         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        return view('inventario.equipo.index');
    }

    public function listar(Request $request)
    {
        return view('inventario.equipo.listar');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $personal = Tipo::join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia');

        return view('inventario.equipo.create');
    }

    public function dashboard(Request $request)
    {
        $tipos = Tipo::get();

        for ($i=0; $i < count($tipos); $i++) {
            $subtipo = SubTipo::where('IdTipo', $tipos[$i]->IdTipo)->get();
            $tipos[$i]["hijos"] = $subtipo;
            for ($j=0; $j < count($subtipo); $j++) {
                $cantidad_eq_sin_asginar =  Equipo::from('Equipo as eq')
                ->select('*')
                ->join('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
                ->join('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
                ->join('Asignacion as asi','eq.IdEquipo','=','asi.IdEquipo')
                ->where('subt.IdSubTipo','=',$subtipo[$j]["IdSubTipo"])
                ->where('eq.IdDependencia','=',$request->user()->dependencias->IdDependencia)
                ->where('eq.baja','=',0)
                ->count();

                $equipos =  Equipo::from('Equipo as eq')
                ->select('*')
                ->join('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
                ->join('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
                ->where('subt.IdSubTipo','=',$subtipo[$j]["IdSubTipo"])
                ->where('eq.IdDependencia','=',$request->user()->dependencias->IdDependencia)
                ->where('eq.baja','=',0)
                ->count();
                $tipos[$i]["hijos"][$j]["noasignados"] =  $equipos-$cantidad_eq_sin_asginar;
                $tipos[$i]["hijos"][$j]["equipos"] =  $equipos;
            }



        }


        $view = view('inventario.equipo.dashboard',compact('tipos'))->render();
        return response()->json(['html'=>$view]);
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla(Request $request)
    {

        $subt = SubTipo::where('Nombre',$request->subtipo)->first();

        $soloequipos = Equipo::select('Equipo.IdEquipo as IdEquipo','CodPatrimonial', 'Responsable',
                                'Usuario','asi.FAsignacion as FAsignacion','IdAsignacion')
                            ->leftJoin('Asignacion as asi','Equipo.IdEquipo','=','asi.IdEquipo')
                            ->where('Equipo.IdSubTipo','=',$subt->IdSubTipo)
                            ->where('Equipo.IdDependencia','=',$request->user()->dependencias->IdDependencia)
                            ->where('Equipo.Baja','=',"0");


        $equipos = Personal::from('Personal as usu')->RightJoinSub($soloequipos,'Equipo',function($join){
                    $join->on('usu.IdPersonal','=','Equipo.Usuario');
        })->leftJoin('Personal as resp','Equipo.Responsable','=','resp.IdPersonal')
        ->select('Equipo.IdEquipo as IdEquipo','Equipo.CodPatrimonial', 'resp.Nombres as Responsable','usu.Nombres as Usuario','Equipo.FAsignacion as FAsignacion','IdAsignacion')
        ->get();

        $subtipo = $request["subtipo"];

        $view = view('inventario.equipo.tabla',compact('equipos','subtipo'))->render();
        return response()->json(['html'=>$view]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subtipo(Request $request,$subtipo)
    {
        return view('inventario.equipo.subtipo.index',compact('subtipo'));

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
        if ($subtipo == "CPU" || $subtipo == "ALL_IN_ONE") {
            $view_create =  view('inventario.equipo.subtipo.CPU.create',compact('equipo','subt','tipo','crtpdt','marcas'));
        }else{
            $equipo->Host = null;
        $equipo->IP = null;
            $view_create =  view('inventario.equipo.subtipo.create',compact('equipo','subt','tipo','crtpdt','marcas'));
        }

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
        $attr["NomTipo"] = $tipo->Nombre;
        $subtipo = SubTipo::where('Nombre',$attr["NomSubTipo"])->first();
        $attr["IdSubTipo"] = $subtipo->IdSubTipo;
        $attr["NomSubTipo"] = $subtipo->Nombre;
        $marca = Marca::where('IdMarca',$attr["IdMarca"])->first();
        $attr["NomMarca"] = $marca->Nombre;


        $attr["IdDependencia"] = $request->user()->dependencias->IdDependencia;

        $equipo = Equipo::create($attr);
        return redirect()->route('inventario.asignacion.create',['Equipo' => $equipo["IdEquipo"]]);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subtipo_edit(Request $request,$subtipo,$Equipo)
    {

        $crtpdt = "Editar";
        $subt = SubTipo::where('Nombre',$subtipo)->first();
        $tipo = Tipo::where('IdTipo',$subt->IdTipo)->first();
        $marcas = Marca::get();


        $equipo = Equipo::where('IdEquipo', $Equipo)->first();
        if ($subtipo == "CPU" || $subtipo == "ALL_IN_ONE") {
            $view_create =  view('inventario.equipo.subtipo.CPU.create',compact('equipo','subt','tipo','crtpdt','marcas'));
        }else{
            $equipo->Host = null;
            $equipo->IP = null;
            $view_create =  view('inventario.equipo.subtipo.create',compact('equipo','subt','tipo','crtpdt','marcas'));
        }
        return $view_create;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subtipo_update($Equipo,Request $request)
    {
        $eq = Equipo::find($Equipo);

        $attr = $request->all();
        $tipo = Tipo::where('Nombre',$attr["NomTipo"])->first();
        $attr["IdTipo"] = $tipo->IdTipo;
        $attr["NomTipo"] = $tipo->Nombre;
        $subtipo = SubTipo::where('Nombre',$attr["NomSubTipo"])->first();
        $attr["IdSubTipo"] = $subtipo->IdSubTipo;
        $attr["NomSubTipo"] = $subtipo->Nombre;
        $marca = Marca::where('IdMarca',$attr["IdMarca"])->first();
        $attr["NomMarca"] = $marca->Nombre;
        $modelo = Modelo::where('IdModelo',$attr["IdModelo"])->first();
        $attr["NomModelo"] = $modelo->Nombre;
        $eq->update($attr);


        //Validar si esta asignado
        $asignado = Asignacion::where('IdEquipo',$eq->IdEquipo)->first();

        if ($asignado) {
            return redirect()->route('inventario.asignacion.edit',['asignacion' => $asignado["IdAsignacion"]]);
        }else{
            return redirect()->route('inventario.asignacion.create',['Equipo' => $eq["IdEquipo"]]);
        }
        return $asignado;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subtipo_delete(Request $request)
    {
        $equipo = Equipo::from('Equipo as eq')
            ->select('eq.IdEquipo as IdEquipo','tip.Nombre as Tipo','subt.Nombre as SubTipo','mod.Nombre as Modelo','mar.Nombre as Marca','CodPatrimonial','NumSerie',
                        'res.Nombres as Responsable','usu.Nombres as Usuario',
                        'asi.FAsignacion as FAsignacion')
            ->leftJoin('Asignacion as asi','eq.IdEquipo','=','asi.IdEquipo')
            ->leftJoin('Personal as usu','asi.Usuario','=','usu.IdPersonal')
            ->leftJoin('Personal as res','asi.Responsable','=','res.IdPersonal')
            ->leftJoin('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
            ->leftJoin('Marca as mar','mod.IdMarca','=','mar.IdMarca')
            ->leftJoin('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
            ->leftJoin('Tipo as tip','subt.IdTipo','=','tip.IdTipo')
            ->where('eq.IdEquipo','=',$request->equipo)
            ->first();


            $view = view('inventario.equipo.subtipo.modal_eliminar',compact('equipo'))->render();
            return response()->json(['html'=>$view]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subtipo_destroy(Request $request,$id)
    {
        $asignado = Asignacion::where('IdEquipo',$id)->forceDelete();
        $eq = Equipo::find($id)->forceDelete();


        return 1;
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modalbaja(Request $request)
    {

        $equipo = Equipo::select('eq.IdEquipo as IdEquipo','tip.Nombre as Tipo','subt.Nombre as SubTipo','mod.Nombre as Modelo','mar.Nombre as Marca','CodPatrimonial','NumSerie')
                            ->from('Equipo as eq')
                            ->join('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
                            ->join('Marca as mar','mod.IdMarca','=','mar.IdMarca')
                            ->join('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
                            ->join('Tipo as tip','subt.IdTipo','=','tip.IdTipo')
                            ->where('eq.IdEquipo','=',$request->IdEquipo)
                            ->first();
        $view = view('inventario.equipo.subtipo.modal_baja',compact('equipo'))->render();
        return response()->json(['html'=>$view]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function baja(Request $request)
    {

        $equipo = Equipo::find($request->IdEquipo);
        $attr["Baja"] = 1;
        $attr["FBaja"] = $request->FBaja;


        $equipo->update($attr);

        return 1;
    }

}

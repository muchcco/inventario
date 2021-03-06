<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use App\Asignacion;
use App\Personal;
use App\Equipo;
use App\AsignacionHistorico;
use Yajra\Datatables\Datatables;
use App\Marca;
use DB;

class BusquedaxUsuarioController extends Controller
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
    public function buscarusuario()
    {

        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')
                        ->orderBy('Nombre', 'asc')
                        ->get();
        $marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')
                        ->orderBy('Nombre', 'asc')
                        ->get();

        return view('inventario.busquedaxusuario.buscarusuario',compact('tipos','marcas'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla(Request $request)
    {
        $soloequipos = Equipo::from("Equipo as eq")
                                ->select('eq.IdEquipo as IdEquipo','tip.IdTipo as IdTipo','tip.Nombre as Tipo','subt.IdSubTipo as IdSubTipo','subt.Nombre as SubTipo','mar.IdMarca as IdMarca','mar.Nombre as Marca','mod.IdModelo as IdModelo','mod.Nombre as Modelo','CodPatrimonial', 'Responsable','Usuario',DB::raw('replace(convert(NVARCHAR,asi.FAsignacion, 113), \' \', \'/\') as FAsignacion'),'IdAsignacion')
                                ->leftJoin('Asignacion as asi','eq.IdEquipo','=','asi.IdEquipo')
                                ->join('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
                                ->join('Marca as mar','mod.IdMarca','=','mar.IdMarca')
                                ->join('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
                                ->join('Tipo as tip','subt.IdTipo','=','tip.IdTipo')
                                ->where('eq.Baja','=',"0")
                                ->where(function ($query) use ($request) {
                                    if ($request->IdTipo != '') {
                                        $query->where('tip.IdTipo',"=", $request->IdTipo);
                                    }
                                    if ($request->IdMarca != '') {
                                        $query->where('mar.IdMarca',"=", $request->IdMarca);
                                    }
                                    if ($request->IdSubTipo != '') {
                                        $query->where('subt.IdSubTipo',"=", $request->IdSubTipo);
                                    }
                                    if ($request->IdModelo != '') {
                                        $query->where('mod.IdModelo',"=", $request->IdModelo);
                                    }
                                    if ($request->CodPatrimonial != '') {

                                        $CodPatrimonial = "%".$request->CodPatrimonial."%";
                                        $query->where('eq.CodPatrimonial',"like", $CodPatrimonial);

                                    }
                                    $query->where('eq.IdDependencia',"=", $request->user()->dependencias->IdDependencia);
                                });


    $equipos = Personal::from('Personal as usu')
                        ->RightJoinSub($soloequipos,'eq',function($join){
                            $join->on('usu.IdPersonal','=','eq.Usuario');
                        })
                        ->where(function ($query) use ($request) {
                            if ($request->resDNI != '') {
                                $resDNI = "%".$request->resDNI."%";
                                $query->where('res.DNI',"like", $resDNI);
                            }
                            if ($request->IdResponsable != '') {
                                $query->where('res.IdPersonal',"=", $request->IdResponsable);
                            }
                            if ($request->usuDNI != '') {
                                $usuDNI = "%".$request->usuDNI."%";
                                $query->where('usu.DNI',"like", $usuDNI);
                            }
                            if ($request->IdUsuario) {
                                $query->where('usu.IdPersonal',"=", $request->IdUsuario);
                            }
                        })
                        ->leftJoin('Personal as res','eq.Responsable','=','res.IdPersonal')
                        ->orderBy('IdEquipo', 'asc')
                        ->select('eq.IdEquipo as IdEquipo','eq.IdTipo as IdTipo','eq.Tipo as Tipo','eq.IdSubTipo as IdSubTipo','eq.SubTipo as SubTipo','eq.IdMarca as IdMarca','eq.Marca as Marca','eq.IdModelo as IdModelo','eq.Modelo as Modelo','eq.CodPatrimonial',
                        'usu.IdPersonal as IdUsuario','usu.DNI as UsuDNI',DB::raw("CONCAT(usu.Nombres,' ',usu.ApePat,' ',usu.ApeMat) AS Usuario"),
                        'res.IdPersonal as IdResponsable','res.DNI as ResDNI',DB::raw("CONCAT(res.Nombres,' ',res.ApePat,' ',res.ApeMat) AS Responsable"),
                        DB::raw('replace(convert(NVARCHAR,eq.FAsignacion, 106), \' \', \'/\') as FAsignacion'),'IdAsignacion')
                        ->get();


    $datatable = Datatables::of($equipos)
                        ->make(true);

    return $datatable;
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cantidades(Request $request)
    {
        $soloequipos = Equipo::from("Equipo as eq")
                                ->select('eq.IdEquipo as IdEquipo','tip.IdTipo as IdTipo','tip.Nombre as Tipo','subt.IdSubTipo as IdSubTipo','subt.Nombre as SubTipo','mar.IdMarca as IdMarca','mar.Nombre as Marca','mod.IdModelo as IdModelo','mod.Nombre as Modelo','CodPatrimonial', 'Responsable','Usuario',DB::raw('replace(convert(NVARCHAR,asi.FAsignacion, 106), \' \', \'/\') as FAsignacion'),'IdAsignacion')
                                ->leftJoin('Asignacion as asi','eq.IdEquipo','=','asi.IdEquipo')
                                ->join('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
                                ->join('Marca as mar','mod.IdMarca','=','mar.IdMarca')
                                ->join('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
                                ->join('Tipo as tip','subt.IdTipo','=','tip.IdTipo')
                                ->where('eq.Baja','=',"0")
                                ->where(function ($query) use ($request) {
                                    if ($request->IdTipo != '') {
                                        $query->where('tip.IdTipo',"=", $request->IdTipo);
                                    }
                                    if ($request->IdMarca != '') {
                                        $query->where('mar.IdMarca',"=", $request->IdMarca);
                                    }
                                    if ($request->IdSubTipo != '') {
                                        $query->where('subt.IdSubTipo',"=", $request->IdSubTipo);
                                    }
                                    if ($request->IdModelo != '') {
                                        $query->where('mod.IdModelo',"=", $request->IdModelo);
                                    }
                                    if ($request->CodPatrimonial != '') {
                                        $CodPatrimonial = "%".$request->CodPatrimonial."%";
                                        $query->where('eq.CodPatrimonial',"like", $CodPatrimonial);
                                    }
                                    $query->where('eq.IdDependencia',"=", $request->user()->dependencias->IdDependencia);
                                });


    $equipos = Personal::from('Personal as usu')
                        ->RightJoinSub($soloequipos,'eq',function($join){
                            $join->on('usu.IdPersonal','=','eq.Usuario');
                        })
                        ->where(function ($query) use ($request) {
                            if ($request->resDNI != '') {
                                $resDNI = "%".$request->resDNI."%";
                                $query->where('res.DNI',"like", $resDNI);
                            }
                            if ($request->IdResponsable != '') {
                                $query->where('res.IdPersonal',"=", $request->IdResponsable);
                            }
                            if ($request->usuDNI != '') {
                                $usuDNI = "%".$request->usuDNI."%";
                                $query->where('usu.DNI',"like", $usuDNI);
                            }
                            if ($request->IdUsuario) {
                                $query->where('usu.IdPersonal',"=", $request->IdUsuario);
                            }
                        })
                        ->leftJoin('Personal as res','eq.Responsable','=','res.IdPersonal')
                        ->orderBy('IdEquipo', 'asc')
                        ->select('eq.IdEquipo as IdEquipo','eq.IdTipo as IdTipo','eq.Tipo as Tipo','eq.IdSubTipo as IdSubTipo','eq.SubTipo as SubTipo','eq.IdMarca as IdMarca','eq.Marca as Marca','eq.IdModelo as IdModelo','eq.Modelo as Modelo','eq.CodPatrimonial',
                        'usu.IdPersonal as IdUsuario','usu.DNI as UsuDNI',DB::raw("CONCAT(usu.Nombres,' ',usu.ApePat,' ',usu.ApeMat) AS Usuario"),
                        'res.IdPersonal as IdResponsable','res.DNI as ResDNI',DB::raw("CONCAT(res.Nombres,' ',res.ApePat,' ',res.ApeMat) AS Responsable"),
                        DB::raw('replace(convert(NVARCHAR,eq.FAsignacion, 106), \' \', \'/\') as FAsignacion'),'IdAsignacion')
                        ->get();

    $resultado = [];
    $cantidadEquipos = count($equipos);
    $sinAsignar = 0;
    for ($i=0; $i < $cantidadEquipos; $i++) {


        if ($equipos[$i]["UsuDNI"] == null || $equipos[$i]["UsuDNI"] == "" || $equipos[$i]["UsuDNI"] == "null" ) {

            $sinAsignar++;
        }
    }
    $resultado["total"] = $cantidadEquipos;
    $resultado["sinAsignar"] = $sinAsignar;
    return $resultado;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modal_create($Equipo)
    {
        $subTipos = Equipo::select('SubTipo.Nombre')
        ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
        ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
        ->where('IdEquipo', '=', $Equipo)
        ->first();

        return view('inventario.asignacion.modal_asignar',compact('Equipo','subTipos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modal_store(Request $request)
    {
        $request["Responsable"] = $request->responsable;
        $request["Usuario"] = $request->usuario;
        if($request->Utilizado == "on"){
            $request["Utilizado"] = 1;
        }else{
            $request["Utilizado"] = 0;
        }
        $subTipos = Equipo::select('SubTipo.Nombre')
                    ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
                    ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
                    ->where('IdEquipo', '=', $request->IdEquipo)
                    ->first();

        $attr = $request->all();

        $subtipo = $subTipos->Nombre;
        $response_data = Asignacion::create($attr);
        return redirect()->route('inventario.equipo.subtipo',['subtipo' => $subtipo]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modal_reasignar(Request $request)
    {

        $asignado = Asignacion::select(  'IdAsignacion',DB::raw('replace(convert(NVARCHAR,FAsignacion, 106), \' \', \'/\') as FAsignacion'),'Utilizado',
                                            'res.IdPersonal as IdResponsable', DB::raw("CONCAT(res.Nombres,' ',res.ApePat,' ',res.ApeMat) AS Responsable"),
                                            'usu.IdPersonal as IdUsuario', DB::raw("CONCAT(usu.Nombres,' ',usu.ApePat,' ',usu.ApeMat) AS Usuario"))
                                ->from('Asignacion as asi')
                                ->join('Personal as res','asi.Responsable','=','res.IdPersonal')
                                ->join('Personal as usu','asi.Usuario','=','usu.IdPersonal')
                                ->where('asi.IdAsignacion','=',$request->asignacion)
                                ->first();

        $equipo = $request->equipo;

        $view = view('inventario.asignacion.modal_reasignar',compact('asignado','equipo'))->render();
        return $view ;
    }


            /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $product
     * @return \Illuminate\Http\Response
     */
    public function modal_reasignado(Request $request,$asignacion)
    {

        $request["Responsable"] = $request->responsable;
        $request["Usuario"] = $request->usuario;
        if($request->Utilizado == "on"){
            $request["Utilizado"] = 1;
        }else{
            $request["Utilizado"] = 0;
        }

        $equipo = Equipo::select('SubTipo.Nombre' , 'CodPatrimonial')
                    ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
                    ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
                    ->where('IdEquipo', '=', $request->IdEquipo)
                    ->first();
        $attr = $request->all();

        $subtipo = $equipo->Nombre;


        $asignacion = Asignacion::find($asignacion);

        $asignacionHistorico = new  AsignacionHistorico;
        $asignacionHistorico->IdAsignacion = $asignacion->IdAsignacion;
        $asignacionHistorico->FAsignacion = date('Y-m-d', strtotime($asignacion->FAsignacion));
        $asignacionHistorico->FDevolucion = date('Y-m-d', strtotime($request->FAsignacion));
        $asignacionHistorico->IdEquipo = $asignacion->IdEquipo;
        $asignacionHistorico->Usuario = $asignacion->Usuario;
        $asignacionHistorico->Responsable = $asignacion->Responsable;
        $asignacionHistorico->Utilizado = $asignacion->Utilizado;
        $asignacionHistorico->save();


        $request["Responsable"] = $request->responsable;
        $request["Usuario"] = $request->usuario;
        if($request->Utilizado == "on"){
            $request["Utilizado"] = 1;
        }else{
            $request["Utilizado"] = 0;
        }

        $asignacion->update($request->all());


        return 1;
    }

}

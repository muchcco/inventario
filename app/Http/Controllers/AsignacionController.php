<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\Asignacion;
use App\AsignacionHistorico;
use App\Equipo;
class AsignacionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($Equipo)
    {
        $subTipos = Equipo::select('SubTipo.Nombre')
        ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
        ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
        ->where('IdEquipo', '=', $Equipo)
        ->first();

        return view('inventario.asignacion.create',compact('Equipo','subTipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request["Responsable"] = $request->responsable;
        $request["Usuario"] = $request->usuario;
        if($request->Utilizado == "on"){
            $request["Utilizado"] = 1;
        }else{
            $request["Utilizado"] = 0;
        }
        $subTipos = Equipo::select('SubTipo.Nombre','Equipo.CodPatrimonial')
                    ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
                    ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
                    ->where('IdEquipo', '=', $request->IdEquipo)
                    ->first();

        $attr = $request->all();

        $subtipo = $subTipos->Nombre;
        $response_data = Asignacion::create($attr);
        return redirect()->route('inventario.equipo.subtipo',['subtipo' => $subtipo])
                        ->with('success',$subtipo.' con codigo Patrimonial: '.$subTipos->CodPatrimonial . '  asignado correctamente ');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($asignado)
    {
        //Validar si esta asignado
        $asignado = Asignacion::where('IdAsignacion',$asignado)->first();
        $responsable = Personal::select('*', 'Dependencia.Nombre as Dependencia')
                                ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                                ->where('IdPersonal',$asignado->Responsable)
                                ->first();

        $usuario = Personal::select('*', 'Dependencia.Nombre as Dependencia')
                            ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                            ->where('IdPersonal',$asignado->Usuario)->first();

        $subTipos = Equipo::select('SubTipo.Nombre')
                            ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
                            ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
                            ->where('IdEquipo', '=', $asignado->IdEquipo)
                            ->first();

        $view = view('inventario.asignacion.edit',compact('asignado','responsable','usuario','subTipos'))->render();
        return $view ;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$asignacion)
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
        $asignado = Asignacion::find($asignacion);
        $asignado->update($request->all());
        return redirect()->route('inventario.equipo.subtipo',['subtipo' => $subtipo])
                        ->with('success',$subtipo.' con codigo Patrimonial: '.$equipo->CodPatrimonial . '  actualizado correctamente ');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $product
     * @return \Illuminate\Http\Response
     */
    public function desasignar(Request $request)
    {
        $asignado = Asignacion::select('IdAsignacion','resp.Nombres as RespNombre','resp.ApePat as RespApePat','resp.ApeMat as RespApeMat',
                                        'usu.Nombres as UsuNombre','usu.ApePat as UsuApePat','usu.ApeMat as UsuApeMat','FAsignacion')
                                ->from('Asignacion as asi')
                                ->join('Personal as resp','asi.Responsable','=','resp.IdPersonal')
                                ->join('Personal as usu','asi.Usuario','=','usu.IdPersonal')
                                ->where('IdAsignacion',$request->asignacion)
                                ->first();

        $view = view('inventario.asignacion.modal_desasignar',compact('asignado'))->render();
        return response()->json(['html'=>$view]);

    }

    public function desasignado(Request $request)
    {

        $asignacion = Asignacion::find($request->IdAsignacion);
        $asignacion->FDevolucion = $request->FDevolucion;
        $asignacionHistorico = new  AsignacionHistorico;


        $asignacionHistorico->IdAsignacion = $asignacion->IdAsignacion;
        $asignacionHistorico->FAsignacion = $asignacion->FAsignacion;
        $asignacionHistorico->FDevolucion = $asignacion->FDevolucion;
        $asignacionHistorico->IdEquipo = $asignacion->IdEquipo;
        $asignacionHistorico->Usuario = $asignacion->Usuario;
        $asignacionHistorico->Responsable = $asignacion->Responsable;
        $asignacionHistorico->Utilizado = $asignacion->Utilizado;
        $asignacionHistorico->save();


        $asignacion = Asignacion::find($request->IdAsignacion)->forceDelete();
        return 1;
    }



        /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reasignar($asignado)
    {
        //Validar si esta asignado
        $asignado = Asignacion::where('IdAsignacion',$asignado)->first();
        $responsable = Personal::select('*', 'Dependencia.Nombre as Dependencia')
                                ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                                ->where('IdPersonal',$asignado->Responsable)
                                ->first();

        $usuario = Personal::select('*', 'Dependencia.Nombre as Dependencia')
                            ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                            ->where('IdPersonal',$asignado->Usuario)->first();

        $subTipos = Equipo::select('SubTipo.Nombre')
                            ->join('Modelo','Equipo.IdModelo','=','Modelo.IdModelo')
                            ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
                            ->where('IdEquipo', '=', $asignado->IdEquipo)
                            ->first();

        $view = view('inventario.asignacion.reasignar',compact('asignado','responsable','usuario','subTipos'))->render();
        return $view ;
    }



        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $product
     * @return \Illuminate\Http\Response
     */
    public function reasignado(Request $request,$asignacion)
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
        $asignacionHistorico->FAsignacion = $asignacion->FAsignacion;
        $asignacionHistorico->FDevolucion = $request->FAsignacion;
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


        return redirect()->route('inventario.equipo.subtipo',['subtipo' => $subtipo])
                        ->with('success',$subtipo.' con codigo Patrimonial: '.$equipo->CodPatrimonial . '  reasignado correctamente ');
    }



}

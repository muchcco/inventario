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

        $subtipos = SubTipo::join('Tipo','Tipo.idTipo','=','SubTipo.IdTipo')->select('Tipo.nombre as TipoNom'  , 'SubTipo.IdSubTipo', 'SubTipo.Nombre')->get();


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
        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();
        $view_create =  view('inventario.subtipo.create',compact('tipos'))->render();
        return response()->json(['html'=>$view_create]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $attr = $request->all();
            $response_data = SubTipo::create($attr);
            return Response::json( $response_data );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $subtipo = SubTipo::select('SubTipo.IdSubTipo as IdSubTipo'  , 'SubTipo.IdTipo', 'SubTipo.Nombre')->where('IdSubTipo', $request->subtipo)->first();
        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();


        $view = view('inventario.subtipo.edit',compact('subtipo','tipos'))->render();
        return response()->json(['html'=>$view]);
        exit;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $SubTipo = SubTipo::find($id);

        $SubTipo->Nombre = $request->Nombre;

        $SubTipo->IdTipo = $request->IdTipo;

        if($SubTipo->save()){
            return 1;
        }else{
            return 0;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Marca = SubTipo::find($id)->forceDelete();

        return 1;

    }
}

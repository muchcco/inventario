<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Modelo;
use App\Tipo;
use App\SubTipo;
use Response;

use Illuminate\Http\Request;

class ModeloController extends Controller
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
        $request->user()->authorizeRoles('Administrador');
        return view('inventario.modelo.index');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        $modelos = Modelo::select(  'Modelo.IdModelo as IdModelo',
                                    'Modelo.Nombre as ModeloNombre',
                                    'Marca.Nombre as MarcaNombre',
                                    'SubTipo.Nombre as SubTipoNombre',
                                    'Tipo.Nombre as TipoNombre'
                                    )->
                            join('Marca','Marca.IdMarca','=','Modelo.IdMarca')->
                            join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')->
                            join('Tipo','Tipo.IdTipo','=','SubTipo.IdTipo')->
                            get();


        $view = view('inventario.modelo.tabla',compact('modelos'))->render();
        return response()->json(['html'=>$view]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->orderBy('Nombre', 'asc')->get();
        $marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')->orderBy('Nombre', 'asc')->get();
        $view_create =  view('inventario.modelo.create',compact('tipos','marcas'))->render();
        return response()->json(['html'=>$view_create]);
    }

    //Trae todos los subtipos
    public function subtipos(Request $request)
    {

        if ($request->tipo == "") {
            $subtipo = SubTipo::select('SubTipo.IdSubTipo as IdSubTipo'  , 'SubTipo.IdTipo', 'SubTipo.Nombre')
                                ->orderBy('SubTipo.Nombre', 'asc')
                                ->get();
            return $subtipo;
        }
        $subtipo = SubTipo::select('SubTipo.IdSubTipo as IdSubTipo'  , 'SubTipo.IdTipo', 'SubTipo.Nombre')
                            ->orderBy('SubTipo.Nombre', 'asc')
                            ->where('IdTipo', $request->tipo)->get();
        return $subtipo;
        exit;
    }

    //Trae todos los modelo
    public function modelos(Request $request)
    {

        $modelos = Modelo::select('Modelo.IdModelo as IdModelo','Modelo.Nombre as Nombre')
                ->Join('SubTipo as subt','Modelo.IdSubTipo','=','subt.IdSubTipo')
                ->where(function ($query) use ($request) {
                    if ($request->marca != '') {
                        $query->where('IdMarca',"=", $request->marca);
                    }
                    if ($request->subtipo != '') {
                        $query->where('subt.IdSubtipo',"=", $request->subtipo);
                    }
                    if ($request->tipo != '') {
                        $query->where('IdTipo',"=", $request->tipo);
                    }
                })
                ->orderBy('Nombre', 'asc')
                ->get();

        return $modelos;
        exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
            $attr = $request->all();
            $response_data = Modelo::create($attr);
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
        $request->user()->authorizeRoles('Administrador');
        $modelo = Modelo::select('Modelo.IdModelo as IdModelo','Modelo.IdMarca as IdMarca', 'Modelo.Nombre as ModeloNombre', 'Modelo.IdSubTipo','Tipo.IdTipo')
                        ->join('SubTipo','SubTipo.IdSubTipo','=','Modelo.IdSubTipo')
                        ->join('Tipo','Tipo.IdTipo','=','SubTipo.IdTipo')
                        ->where('IdModelo', $request->modelo)
                        ->first();

        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();
        $marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')->get();

        $view = view('inventario.modelo.edit',compact('modelo','tipos','marcas'))->render();
        return response()->json(['html'=>$view]);
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
        $request->user()->authorizeRoles('Administrador');

        $modelo = Modelo::find($id);


        $modelo->IdSubTipo = $request->IdSubTipo;
        $modelo->IdMarca = $request->IdMarca;
        $modelo->Nombre = $request->Nombre;

        if($modelo->save()){
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
    public function destroy(Request $request,$id)
    {
        $request->user()->authorizeRoles('Administrador');

        $Marca = Modelo::find($id)->forceDelete();

        return 1;

    }



}

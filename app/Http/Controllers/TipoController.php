<?php

namespace App\Http\Controllers;

use App\Tipo;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TipoController extends Controller
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
        return view('inventario.tipo.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');

        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();

        $view = view('inventario.tipo.tabla',compact('tipos'))->render();
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
        $view_create =  view('inventario.tipo.create')->render();
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
        $request->user()->authorizeRoles('Administrador');
            $request->user()->authorizeRoles('Administrador');
            $attr = $request->all();
            $response_data = Tipo::create($attr);
            return Response::json( $response_data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shows($id)
    {

        //
                var_dump("234");
    die();
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
        $tipo = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->where('IdTipo', $request->tipo)->first();
        $view = view('inventario.tipo.edit',compact('tipo'))->render();
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
        $request->user()->authorizeRoles('Administrador');


       $tipo = DB::select('exec [udp_Tipo_ups] ?,?',array($id,$request->input('Nombre')));

        return $tipo;

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
        $Tipo = Tipo::find($id)->forceDelete();
        return $Tipo;



    }
}

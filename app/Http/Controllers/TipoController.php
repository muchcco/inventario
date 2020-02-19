<?php

namespace App\Http\Controllers;

use App\Tipo;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TipoController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventario.tipo.index');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla()
    {
        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();

        $view = view('inventario.tipo.tabla',compact('tipos'))->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $attr = $request->all();
            $response_data = Tipo::create($attr);
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

        $tipo = Tipo::select('tipos.id', 'tipos.nombre')->where('id', $request->tipo)->first();

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

        $Tipo = Tipo::find($id);
        $Tipo->nombre = $request->nombre;
        if($Tipo->save()){
            return 1;
        }else{
            return 0;
        }

        //
    }
}
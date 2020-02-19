<?php

namespace App\Http\Controllers;

use App\Marca;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('inventario.marca.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla()
    {
        $modelos = Marca::select('Marca.IdMarca', 'Marca.Nombre')->get();

        $view = view('inventario.marca.tabla',compact('modelos'))->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view_create =  view('inventario.marca.create')->render();
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

            $response_data = Marca::create($attr);
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

        $marca = Marca::select('marca.IdMarca', 'marca.Nombre')->where('IdMarca', $request->marca)->first();
        $view = view('inventario.marca.edit',compact('marca'))->render();
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
        $Marca = Marca::find($id);

        $Marca->Nombre = $request->Nombre;


        if($Marca->save()){
            return 1;
        }else{
            return 0;
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Marca = Marca::find($id)->forceDelete();
        return true;

    }

}

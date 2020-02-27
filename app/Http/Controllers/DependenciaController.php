<?php

namespace App\Http\Controllers;

use Response;
use App\Dependencia;
use Validator;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('generales.dependencia.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla()
    {
        $dependencia = Dependencia::get();

        for ($i=0; $i < $dependencia->count() ; $i++) {

        }

        return json_encode($dependencia);
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
        $modelos = Dependencia::select('Dependencia.IdDependencia', 'Dependencia.Nombre')->get();
        $cantidad = count($modelos);
        if ($cantidad == 0) {
            $modelos [] = array("IdDependencia" => 0,"Nombre" => "INIA");
        }
        return $modelos;
        $view_create =  view('generales.dependencia.create')->render();
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
}

<?php

namespace App\Http\Controllers;

Use App\Equipo;
use App\SubTipo;
use App\Tipo;
use Carbon\carbon;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}

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
use App\Software;
use Carbon\carbon;
use DB;


use Illuminate\Http\Request;

class SoftwareController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function so(Request $request)
    {
        $sistOperativos = Software::select("IdSoftware as id",DB::raw("CONCAT(Nombre,' ',Version) AS text"))
                                    ->where('Tipo','like','SO')
                                    ->where(DB::raw("CONCAT(Nombre,' ',Version)"),'like','%'.$request->q.'%')
                                    ->get();

        return $sistOperativos;
    }

    public function sw(Request $request)
    {
        $sistOperativos = Software::select("IdSoftware as id",DB::raw("CONCAT(Nombre,' ',Version) AS text"))
                                    ->where('Tipo','like','SW')
                                    ->where(DB::raw("CONCAT(Nombre,' ',Version)"),'like','%'.$request->q.'%')
                                    ->get();

        return $sistOperativos;
    }

    public function av(Request $request)
    {
        $sistOperativos = Software::select("IdSoftware as id",DB::raw("CONCAT(Nombre,' ',Version) AS text"))
                                    ->where('Tipo','like','AV')
                                    ->where(DB::raw("CONCAT(Nombre,' ',Version)"),'like','%'.$request->q.'%')
                                    ->get();

        return $sistOperativos;
    }

    public function create_so(Request $request)
    {
        $view_create =  view('inventario.software.sistemaoperativo')->render();
        return response()->json(['html'=>$view_create]);
    }


    public function store_so(Request $request)
    {

            $attr = $request->all();

            $response_data = Software::create($attr);

            return $response_data;
    }

    public function create_sw(Request $request)
    {
        $view_create =  view('inventario.software.programas')->render();
        return response()->json(['html'=>$view_create]);
    }


    public function store_sw(Request $request)
    {

            $attr = $request->all();

            $response_data = Software::create($attr);

            return $response_data;
    }

    public function create_av(Request $request)
    {
        $view_create =  view('inventario.software.antivirus')->render();
        return response()->json(['html'=>$view_create]);
    }


    public function store_av(Request $request)
    {

            $attr = $request->all();

            $response_data = Software::create($attr);

            return $response_data;
    }


}

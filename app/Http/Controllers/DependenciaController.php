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

        $arrdep =array();
        $a = 0;
        for ($i=0; $i < $dependencia->count() ; $i++) {
            if ($dependencia[$i]['IdPadre'] == 0) {
                $dep = array();
                $dep['id'] = $dependencia[$i]['IdDependencia'];
                $dep['text'] = $dependencia[$i]['Nombre'];
                $dep['state'] = array("opened"=>"true");
                //array_push($arrdep,$dep);
                $cant = 0;
                for ($j=0; $j < $dependencia->count() ; $j++) {
                    if ($dep['id'] == $dependencia[$j]['IdPadre']) {
                        if ($cant == 0) {
                            $dep['children'] = [];
                            $cant++;
                        }
                        $hijo1 = array();
                        $hijo1['id'] = $dependencia[$j]['IdDependencia'];
                        $hijo1['text'] = $dependencia[$j]['Nombre'];
                        $hijo1['state'] =  array("opened"=>"true");
                        $cant2 = 0;
                        for ($k=0; $k < $dependencia->count() ; $k++) {

                            if ($hijo1['id'] == $dependencia[$k]['IdPadre']) {
                                if ($cant2 == 0) {
                                    $hijo1['children'] = [];
                                    $cant2++;
                                }
                                $hijo2 = array();
                                $hijo2['id'] = $dependencia[$k]['IdDependencia'];
                                $hijo2['text'] = $dependencia[$k]['Nombre'];
                                    $cant3 = 0;
                                    for ($l=0; $l < $dependencia->count() ; $l++) {

                                        if ($hijo2['id'] == $dependencia[$l]['IdPadre']) {
                                            if ($cant3 == 0) {
                                                $hijo2['children'] = [];
                                                $cant3++;
                                            }
                                            $hijo3 = array();
                                            $hijo3['id'] = $dependencia[$l]['IdDependencia'];
                                            $hijo3['text'] = $dependencia[$l]['Nombre'];
                                            $cant4 = 0;
                                                for ($m=0; $m < $dependencia->count() ; $m++) {

                                                    if ($hijo3['id'] == $dependencia[$m]['IdPadre']) {
                                                        if ($cant4 == 0) {
                                                            $hijo3['children'] = [];
                                                            $cant4++;
                                                        }
                                                        $hijo4 = array();
                                                        $hijo4['id'] = $dependencia[$m]['IdDependencia'];
                                                        $hijo4['text'] = $dependencia[$m]['Nombre'];
                                                        array_push($hijo3['children'],$hijo4);
                                                    }
                                                }
                                            array_push($hijo2['children'],$hijo3);
                                        }
                                    }
                                array_push($hijo1['children'],$hijo2);
                            }
                        }
                        array_push($dep['children'],$hijo1);
                    }
                }
                array_push($arrdep,$dep);
            }
        }
        return $arrdep;
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

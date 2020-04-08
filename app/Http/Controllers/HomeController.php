<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\role;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->role->nombre == "Administrador") {
            $dependencia = 0;
        }else{
            $dependencia = $request->user()->dependencias->IdDependencia;
        }
        $datas = DB::select('cantidadDesktop ?',array($dependencia));

        //dd($session);
        //$phone = User::find(1)->role;
        //dd($phone);
                //Auth::logout();
          //      $user = Auth::user();
            //    dd($user);
        foreach ($datas as $data) {
            if ($data->Cantidad == 0) {
                $data->porcentaje = "100%";
            }else{
                $porcentaje = ($data->Utilizado/$data->Cantidad)*100;
                $data->porcentaje = $porcentaje."%";
            }

        }

        return view('inventario/inicio/Welcome',compact('datas'));
    }

    public function equiposPorOrganosDesconcentrados(Request $request){
        $categories = [];
        $arrnoBaja = [];
        $arrbaja = [];
        $datas = DB::select(' equiposPorOrganosDesconcentrados');
        foreach ($datas as $data) {
            array_push($categories,$data->Codigo);
            array_push($arrnoBaja,(int)$data->Utilizable);
            array_push($arrbaja,(int)$data->Baja);
        }
        $noBaja = [];
        $noBaja["name"] = "Utilizable";
        $noBaja["data"] = $arrnoBaja;
        $baja = [];
        $baja["name"] = "Baja";
        $baja["data"] = $arrbaja;
        $series = [];
        array_push($series,$baja);
        array_push($series,$noBaja);
        $grafico = [];
        $grafico["categories"] = $categories;
        $grafico["series"] = $series;
        return $grafico;
    }

    public function equiposPorTipo(Request $request){

            $dependencia = $request->user()->dependencias->IdDependencia;

        $sum = 0;
        $series = [];
        $datas = DB::select('graf_inv_equiposPorTipo ?',array($dependencia));
        foreach ($datas as $data) {
            $serie = [];
            $serie["name"] = $data->Tipo;
            $serie["y"] = (int)$data->equipos;
            $sum = $sum + (int)$data->equipos;

            array_push($series,$serie);

        }
        $grafico["data"] = $series;
        $grafico["total"] = $sum;
        return $grafico;
    }
}

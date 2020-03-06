<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\App;
use App\Usuario;
use App\Dependencia;

use nusoap_client;
use nusoap;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('generales.personal.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $datos = Usuario::select('Nombres')->where('DNI', $request->dni)->get();
        if(count($datos) == 0){
            $client = new nusoap_client(env('SOAP_RUTA'),'wsdl');
            $result = $client->call("consultar", array('arg0' => array( "nuDniConsulta" => $request->dni,
                                                    'nuDniUsuario'          => env('SOAP_DNI_USUARIO'),
                                                    'nuRucUsuario'          => env('SOAP_RUC_USUARIO'),
                                                    'password'              => env('SOAP_PASSWORD'))));
            $datos = $result['return']['deResultado'];

            $codigo = $result['return']['coResultado'];
            $datos->codigo = $codigo;


        }
        //$dec = array_map("utf8_encode", $datos );
        return ($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dependencia(Request $request)
    {

        $busqueda = '%'.$request->q.'%';

        $datos = Dependencia::select('IdDependencia as id','Nombre as text')->where('Nombre', 'like', '%' . $request->q . '%')->get();
        //$tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();
        //$marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')->get();
        return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();
        //$marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')->get();
        return view('generales.personal.create');
    }





}

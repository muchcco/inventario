<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\App;


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



        $client = new nusoap_client("https://ws5.pide.gob.pe/services/ReniecConsultaDni?wsdl",'wsdl');






        $result = $client->call("consultar", array('arg0' => array( "nuDniConsulta" => "74291643",
                                                    'nuDniUsuario'          => "43840691",
                                                    'nuRucUsuario'          => '20131365994',
                                                    'password'              => '43840691')));
dd($result['return']['datosPersona']);
        return "";
        if ($client->fault) {
            echo 'Fallo';
            print_r($result);
        } else {	// Chequea errores
            $err = $client->getError();
            if ($err) {		// Muestra el error
                echo 'Error' . $err ;
            } else {		// Muestra el resultado
                echo 'Resultado';
                print_r ($result);
            }
        }




        return "";
        $client->http_encoding='utf-8';
        $client->defencoding='utf-8';

        $params = array("consultar" => array(
            'nuDniConsulta'          => "74291643",
            'nuDniUsuario'          => "43840691",
            'nuRucUsuario'          => '20131365994',
            'password'              => '43840691'

        ));
        $result = $client->call('consultarResponse', $params);
        //print_r($client);

        $client = new nusoap_client('https://ws5.pide.gob.pe/services/ReniecConsultaDni', 'wsdl');



        $err = $client->getError();

        $result = $client->call('consultar', $params);
        var_dump($result);
        return "123";
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = FALSE;
                                            return true;


                                            return "hola";
        var_dump(env('SOAP_DNI_USUARIO', false));


    }
}

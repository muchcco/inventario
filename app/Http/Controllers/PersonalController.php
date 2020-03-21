<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\App;
use App\Personal;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla()
    {

        $personal = Personal::select('IdPersonal','Personal.Nombres as NomPersonal','ApePat','ApeMat','DNI','Codigo')
                            ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')->get();

        $view = view('generales.personal.tabla',compact('personal'))->render();
        return response()->json(['html'=>$view]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $datos = Personal::select('*')->where('DNI', $request->dni)->get();


        if(count($datos) == 0){
            $client = new nusoap_client(env('SOAP_RUTA'),'wsdl');
            $result = $client->call("consultar", array('arg0' => array( "nuDniConsulta" => $request->dni,
                                                    'nuDniUsuario'          => env('SOAP_DNI_USUARIO'),
                                                    'nuRucUsuario'          => env('SOAP_RUC_USUARIO'),
                                                    'password'              => env('SOAP_PASSWORD'))));
            $soap_res = $result['return']['datosPersona'];
            $datos = [];
            $datos[0]["Nombres"] = $soap_res['prenombres'];
            $datos[0]["ApePat"] = $soap_res['apPrimer'];
            $datos[0]["ApeMat"] = $soap_res['apSegundo'];
            $datos[0]["Nombres"] = $soap_res['prenombres'];
            $datos[0]["codigo"] = $result['return']['coResultado'];

            return ($datos);



        }else{
            $Dependencia = Dependencia::select('Nombre')->where('IdDependencia', $datos[0]["IdDependencia"])->first();
            $datos[0]["codigo"]="1";
            $datos[0]["Dependencia"] = $Dependencia["Nombre"];
            return ($datos);
        }
        //$dec = array_map("utf8_encode", $datos );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dependencia(Request $request)
    {
        //para llenar el select 2
        $busqueda = '%'.$request->q.'%';
        $datos = Dependencia::select('IdDependencia as id','Nombre as text')->where('Nombre', 'like', '%' . $request->q . '%')->get();
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $attr = $request->all();

        $response_data = Personal::create($attr);

        return redirect()->route('generales.personal.index')->with('success','Usuario: '.$request->Nombres . ' registrado correctamente');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($IdPersonal)
    {
        $personal = Personal::join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                            ->select('IdPersonal','Personal.Nombres as Nombres','ApePat','ApeMat','DNI','Email','Anexo','TipoContr','Dependencia.Nombre as NomDependencia','Dependencia.IdDependencia as IdDependencia')
                            ->where('IdPersonal', $IdPersonal)
                            ->first();
        $view = view('generales.personal.edit',compact('personal'))->render();
        return $view ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $personal = Personal::find($id);
        $personal->update($request->all());
        return redirect()->route('generales.personal.index')
                        ->with('success','Usuario: '.$request->Nombres . ' datos actualizados correctamente ');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Marca = Personal::find($id)->forceDelete();

        return 1;

    }


        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        $tipo = $request->tipo;
        $parametro = $request->parametro;
        if (is_numeric($request->parametro)) {
            $results = Personal::select('IdPersonal','Personal.Nombres as NomPersonal','ApePat','ApeMat','DNI','Codigo','Dependencia.Nombre as Dependencia')
                                ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                                ->where('DNI', $request->parametro)->get();
        }else{
            $results = Personal ::select('IdPersonal','Personal.Nombres as NomPersonal','ApePat','ApeMat','DNI','Codigo','Dependencia.Nombre as Dependencia')
                                ->join('Dependencia','Dependencia.IdDependencia','=','Personal.IdDependencia')
                                ->where('Nombres',"like", "%".$request->parametro."%")
                                ->orWhere('ApePat',"like", "%".$request->parametro."%")
                                ->orWhere('ApeMat',"like", "%".$request->parametro."%")
                                ->get();
        }
        $view = view('inventario.asignacion.tabla_asignar_personal',compact('results','tipo','parametro'))->render();
        return $view ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarmodal()
    {
        //$tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')->get();
        //$marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')->get();
        return view('generales.personal.create_modal')->render();
    }


}

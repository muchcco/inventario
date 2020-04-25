<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\AsignacionHistorico;
use App\Personal;
use App\Tipo;
use App\Marca;
use Yajra\Datatables\Datatables;
use DB;
class AsignacionHistoricoController extends Controller
{
    public function __construct()
    {

         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::select('Tipo.IdTipo', 'Tipo.Nombre')
                        ->orderBy('Nombre', 'asc')
                        ->get();
        $marcas = Marca::select('Marca.IdMarca', 'Marca.Nombre')
                        ->orderBy('Nombre', 'asc')
                        ->get();

        return view('inventario.asignacionHistorico.index',compact('tipos','marcas'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabla(Request $request)
    {


        $asignacionHistorico = AsignacionHistorico::select('tip.Nombre as Tipo','tip.IdTipo as IdTipo','subt.Nombre as SubTipo', 'mar.Nombre as Marca', 'mod.Nombre as Modelo','CodPatrimonial',
                                'usu.DNI as UsuDNI',DB::raw("CONCAT(usu.Nombres,' ',usu.ApePat,' ',usu.ApeMat) AS Usuario"),
                                'res.DNI as ResDNI',DB::raw("CONCAT(res.Nombres,' ',res.ApePat,' ',res.ApeMat) AS Responsable"),
                                DB::raw('replace(convert(NVARCHAR,FAsignacion, 106), \' \', \'/\') as FAsignacion'),DB::raw('replace(convert(NVARCHAR,FDevolucion, 106), \' \', \'/\') as FDevolucion'))
                                ->from('AsignacionHistorico as asi')
                                ->Join('Personal as usu','asi.Usuario','=','usu.IdPersonal')
                                ->Join('Personal as res','asi.Responsable','=','res.IdPersonal')
                                ->Join('Equipo as eq','asi.IdEquipo','=','eq.IdEquipo')
                                ->Join('Modelo as mod','eq.IdModelo','=','mod.IdModelo')
                                ->Join('Marca as mar','mod.IdMarca','=','mar.IdMarca')
                                ->Join('SubTipo as subt','mod.IdSubTipo','=','subt.IdSubTipo')
                                ->Join('Tipo as tip','subt.IdTipo','=','tip.IdTipo')
                                ->where(function ($query) use ($request) {
                                    if ($request->IdTipo != '') {
                                        $query->where('tip.IdTipo',"=", $request->IdTipo);
                                    }
                                    if ($request->IdMarca != '') {
                                        $query->where('mar.IdMarca',"=", $request->IdMarca);
                                    }
                                    if ($request->IdSubTipo != '') {
                                        $query->where('subt.IdSubTipo',"=", $request->IdSubTipo);
                                    }
                                    if ($request->IdModelo != '') {
                                        $query->where('mod.IdModelo',"=", $request->IdModelo);
                                    }
                                    if ($request->CodPatrimonial != '') {
                                        $query->where('eq.CodPatrimonial',"like", $request->CodPatrimonial);
                                    }
                                    if ($request->resDNI != '') {
                                        $query->where('res.DNI',"=", $request->resDNI);
                                    }
                                    if ($request->IdResponsable != '') {
                                        $query->where('res.IdPersonal',"=", $request->IdResponsable);
                                    }
                                    if ($request->usuDNI != '') {
                                        $query->where('usu.DNI',"=", $request->usuDNI);
                                    }
                                    if ($request->IdUsuario) {
                                        $query->where('usu.IdPersonal',"=", $request->IdUsuario);
                                    }
                                    $query->where('eq.IdDependencia',"=", $request->user()->dependencias->IdDependencia);



                                })
                                ->get();

        return $datatable = Datatables::of($asignacionHistorico)
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar_personal(request $request)
    {

        $personal = Personal::select('IdPersonal as id',DB::raw("CONCAT(Nombres,' ',ApePat,' ',ApeMat) AS text "))
                            ->where('Nombres','like','%'.$request->q.'%')
                            ->orWhere('ApePat','like','%'.$request->q.'%')
                            ->orWhere('ApeMat','like','%'.$request->q.'%')
                            ->orderBy('text', 'asc')
                            ->get();


        return $personal;
    }

}

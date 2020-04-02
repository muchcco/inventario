<?php

namespace App\Http\Controllers;


use App\role;
use App\User;
use Auth;
use App\Dependencia;
use Carbon\Carbon;

use App\Middleware\TrusuProxies;

use Illuminate\Support\Facades\Hash;

use Response;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class UsuarioController extends Controller
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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        return view('usuarios.index');
    }

    public function tabla(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        $usuarios = role::join('users','users.role_id','=','roles.id')
                            ->select('users.id as idu','users.name as un', 'users.email as ue', 'roles.nombre as rn', 'users.estado as ues')
                            ->get();

        $view = view('usuarios.tabla',compact('usuarios'))->render();


        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        $roles = Role::get();
        $view_create =  view('usuarios.create',compact('roles'))->render();
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
        $request->user()->authorizeRoles('Administrador');
        $input = $request->all();

        if(!empty($input['password']))
        {
            $input['password'] = Hash::make($input['password']);
        }


        $response_data = User::create($input);
        return Response::json( $response_data );
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dependencia(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        $dependencia = Dependencia::select('IdDependencia as id','Nombre as text')
                                    ->where('IdPadre','=','3');
        $central = Dependencia::select('IdDependencia as id','Nombre as text')
                                ->where('IdDependencia','=','2')
                                ->union($dependencia)
                                ->get();
        return($central);
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');
        $usuarios = User::select( 'users.id as uid' ,'users.name as un', 'users.email as ue', 'roles.id as ri' ,'roles.nombre as rn', 'users.estado as ues','dep.IdDependencia as IdDependencia','dep.Nombre as Dependencia')
                        ->join('roles','roles.id','=','users.role_id')
                        ->join('Dependencia as dep','dep.IdDependencia','=','users.IdDependencia')
                        ->where('users.id', $request->modelo)
                        ->first();

        $roles = Role::get();

        $view = view('usuarios.edit',compact('usuarios','roles'))->render();
        return response()->json(['html'=>$view]);

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
        $request->user()->authorizeRoles('Administrador');
        $user = User::find($id);

        if(!empty($request['password']))
        {
            $request['password'] = Hash::make($request['password']);
        }else{
            unset($request['password']);
        }

        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $request->user()->authorizeRoles('Administrador');
        $Marca = User::find($id)->forceDelete();

        return 1;

    }
}

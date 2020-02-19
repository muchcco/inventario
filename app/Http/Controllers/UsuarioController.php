<?php

namespace App\Http\Controllers;


use App\role;
use App\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;

use Response;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios.index');
    }

    public function tabla()
    {
        $usuarios = role::join('users','users.role_id','=','roles.id')
                            ->select('users.name as un', 'users.email as ue', 'roles.nombre as rn', 'users.estado as ues')
                            ->get();

        $view = view('usuarios.tabla',compact('usuarios'))->render();

        
        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $roles = Role::get();
        $usuarios = User::join('roles','roles.id','=','users.role_id')->select('users.name as un', 'users.email as ue', 'roles.nombre as rn', 'users.estado as ues')->where('users.id', $request->roles)->first();
        $view = view('usuarios.edit',compact('roles','usuarios'))->render();
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
        $Modelo = Modelo::find($id);
        $Modelo->id_marca = $request->id_marca;
        $Modelo->nombre = $request->nombre;
        if($Modelo->save()){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = Modelo::find($id);
        $modelo->delete();

    }
}

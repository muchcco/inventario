<?php

namespace App\Http\Controllers;


use App\role;
use App\User;
use Auth;
use Carbon\Carbon;

use App\Middleware\TrusuProxies;

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
    public function index(Request $request)
    {





        return view('usuarios.index');
    }

    public function tabla()
    {
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
        $usuarios = User::select( 'users.id as uid' ,'users.name as un', 'users.email as ue','users.password as up', 'roles.id as ri' ,'roles.nombre as rn', 'users.estado as ues')
                        ->join('roles','roles.id','=','users.role_id')
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }
}

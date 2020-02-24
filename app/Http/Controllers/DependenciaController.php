<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view_create =  view('generales.dependencia.create')->render();
        return response()->json(['html'=>$view_create]);
    }
}

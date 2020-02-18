<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;

class PagesController extends Controller
{
    public function home(){
        return view('welcome');
    }
}

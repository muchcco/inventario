<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'Modelo';

    protected $fillable = ['IdMarca','Nombre'];
}

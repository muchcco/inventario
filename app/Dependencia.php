<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $table = 'Dependencia';

    protected $fillable = ['IdResponsable', 'Nombre', 'Codigo', 'IdPadre'];

}

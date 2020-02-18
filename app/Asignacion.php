<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'Asignacion';

    protected $fillable = ['FAsignacion', 'FDevolucion', 'IdEquipo', 'IdUsuarioActual', 'IdUsuarioResponsable'];


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'Asignacion';

    protected $primaryKey = 'IdAsignacion';

    protected $fillable = ['FAsignacion', 'FDevolucion', 'IdEquipo', 'Usuario', 'Responsable','Utilizado'];

    public $timestamps = false;

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionHistorico extends Model
{
    protected $table = 'AsignacionHistorico';

    protected $primaryKey = 'IdAsignacionHistorico';

    protected $fillable = ['IdAsignacion','FAsignacion', 'FDevolucion', 'IdEquipo', 'Usuario', 'Responsable','Utilizado'];

    public $timestamps = false;
}

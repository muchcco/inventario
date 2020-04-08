<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{

    public function Equipo()
    {
        return $this->belongsToMany('App\Equipo', 'Equipo_Software', 'IdSoftware', 'IdEquipo');
    }


    protected $table = 'Software';

    protected $primaryKey = 'IdSoftware';

    protected $fillable = ['Tipo','Nombre','Version'];

    public $timestamps = false;
}

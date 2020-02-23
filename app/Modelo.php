<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = 'Modelo';

    protected $primaryKey = 'IdModelo';

    protected $fillable = ['IdMarca','IdSubTipo','Nombre'];

    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTipo extends Model
{
    protected $table = 'SubTipo';

    protected $fillable = ['Nombre','idTipo','IdModelo'];
}

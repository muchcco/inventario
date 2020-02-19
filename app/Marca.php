<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'Marca';

    protected $primaryKey = 'IdMarca';

    protected $fillable = ['Nombre'];

    public $timestamps = false;


}

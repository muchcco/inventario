<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $table = 'Dependencia';

    protected $primaryKey = 'IdDependencia';

    protected $fillable = ['Nombre', 'Codigo', 'IdPadre'];

    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespxDepend extends Model
{
    protected $table = 'RespxDepend';

    protected $fillable = ['IdDependencia','IdResponsable','Activo'];

}

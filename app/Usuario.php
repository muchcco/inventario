<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuario';

    protected $primaryKey = 'IdUsuario';

    protected $fillable = ['Nombres','ApePat','ApeMat','DNI','Email','Anexo','IdDependencia','TipoContr'];

    public $timestamps = false;
}

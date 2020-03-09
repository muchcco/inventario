<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'Personal';

    protected $primaryKey = 'IdPersonal';

    protected $fillable = ['Nombres','ApePat','ApeMat','DNI','Email','Anexo','IdDependencia','TipoContr'];

    public $timestamps = false;
}

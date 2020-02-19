<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubTipo;
class Tipo extends Model
{
    protected $table = 'Tipo';

    protected $primaryKey = 'IdTipo';

    protected $fillable = ['Nombre'];

    public $timestamps = false;


}

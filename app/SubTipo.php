<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTipo extends Model
{
    protected $table = 'SubTipo';

    protected $primaryKey = 'IdSubTipo';

    protected $fillable = ['Nombre','IdTipo'];

    public $timestamps = false;

    public function Tipo()
    {

        return $this->belongsTo('App\Tipo', 'IdTipo');
    }
}

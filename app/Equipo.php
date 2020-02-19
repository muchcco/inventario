<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'Equipo';

    protected $fillable = ['NomMarca', 'IdMarca', 'FFabricacion', 'Descripcion', 'IdModelo', 'NomModelo', 'IdUsuarioActual',
                            'IdUsuarioResponsable','Utilizado','IdTipo','NomTipo','IdSubTipo','NomSubTipo','Host',
                            'Perfil','IP','CodPatrimonial','NumSerie','SistOperativo','Imei','NumCel','Anexo'];

}

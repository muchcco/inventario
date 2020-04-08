<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public function Software()
    {
        return $this->belongsToMany('App\Software', 'Equipo_Software', 'IdEquipo', 'IdSoftware');
    }
    public function SistemaOperativo()
    {
        return $this->hasOne('App\Software', 'IdSoftware', 'SistOperativo');
    }
    public function Antivirusav()
    {
        return $this->hasOne('App\Software', 'IdSoftware', 'Antivirus');
    }

    protected $table = 'Equipo';


    protected $primaryKey = 'IdEquipo';


    protected $fillable = ['NomMarca', 'IdMarca', 'FFabricacion', 'Descripcion', 'IdModelo', 'NomModelo', 'IdUsuarioActual',
                            'IdUsuarioResponsable','Utilizado','IdTipo','NomTipo','IdSubTipo','NomSubTipo','Host',
                            'Perfil','IP','CodPatrimonial','NumSerie','SistOperativo','Imei','NumCel','Anexo','Baja','FBaja','IdDependencia',
                            'Memoria','DiscoDuro','ProcMarca','ProcModelo','ProcSerie','AnioAntiguedad','Antivirus'];


    public $timestamps = false;

}

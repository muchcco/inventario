<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public function dependencias(){
        return $this->hasOne('App\Dependencia', 'IdDependencia','IdDependencia');
    }

    public function role(){
        return $this->hasOne('App\role', 'id','role_id');
    }

    public function authorizeRoles($roles){

        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles){

        if (is_array($roles)) {

            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {

            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }


    public function hasRole($role){
        if ($this->role()->where('Nombre', $role)->first()) {
            return true;
        }
        return false;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id','IdDependencia', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

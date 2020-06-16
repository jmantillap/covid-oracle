<?php

namespace App\Entidades;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administradores';
    protected $primaryKey = 'n_id';
    public $incrementing = 'true';

    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_updated_at';

    protected $fillable = ['t_nombrecompleto', 't_login','n_idciudad','t_email','b_habilitado','b_todas','b_ldap'];
    
    protected $guarded =['t_password'];

    protected $hidden = ['t_password',];

    public function getAuthPassword()
    {
      return $this->t_password;
    }

    public function ciudad(){
        return $this->belongsTo('App\Entidades\Ciudad','n_idciudad','n_id');
    } 
}

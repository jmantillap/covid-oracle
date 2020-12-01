<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'n_idusuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = ['n_idsede','t_apellidos','t_nombres','c_codtipo','t_documento','t_idsigaa','t_email','t_telefono','t_jefeinmediatocontacto',
             't_facultadareaempresa','n_idvinculou','password','t_activo','t_sigaa'];

   protected $guarded= ['n_idusuario'];
   //
   protected $table = 'users'; //Esta línea se pone si la tabla se llama de manera diferente


    public function vinculou()
	{
		 return $this->belongsTo('App\Entidades\Vinculou','n_idvinculou');
    }

    public function sede()
	{
		 return $this->belongsTo('App\Entidades\Sedes','n_idsede');
    }

    public function formulario()
    {
        return $this->hasMany('App\Entidades\Formulario','n_idusuario');
    }

    /**
     * Variable que indica si esta en cero, ya lleno el acta de ingreso, si es 1, esta pendiente llenar.
     */
    public $actaPendiente=0;    

}

<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Vacunacion extends Model
{
    protected $primaryKey = 'n_id'; 
    protected $fillable= ['n_idusuario','t_activo','t_vacuna','n_iddesactiva'];
    protected $guarded= ['n_id', 'created_at', 'updated_at'];    //
    protected $table = 'vacunacion';

    public $incrementing = 'true';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function usuarioDesactiva() //trae los datos de usuario administrador que desactivo el acta.
	{
		return $this->belongsTo('App\Entidades\Administrador','n_iddesactiva','n_id');
    }

    public function usuario() //trae los datos de usuario
	{
		 return $this->belongsTo('App\User','n_idusuario');
    }

}

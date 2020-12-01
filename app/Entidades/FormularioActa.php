<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class FormularioActa extends Model
{
    protected $primaryKey = 'n_idformulario_acta'; 
    protected $fillable= ['n_idusuario','t_consentimiento','t_activo','n_iddesactiva','n_semaforo'];
    protected $guarded= ['n_idformulario', 'created_at', 'updated_at'];    //
    protected $table = 'formulario_acta';

    public $incrementing = 'true';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function usuarioDesactiva() //trae los datos de usuario administrador que desactivo el acta.
	{
		return $this->belongsTo('App\Entidades\Administrador','n_iddesactiva','n_id');
    }

}

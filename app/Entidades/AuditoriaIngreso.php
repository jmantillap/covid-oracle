<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class AuditoriaIngreso extends Model
{
    protected $table = 'auditoria_ingreso';
    protected $primaryKey = 'n_id';
    const CREATED_AT = 'dt_created';
    const UPDATED_AT = 'dt_updated';

    protected $fillable = ['n_idadministrador','t_ip','t_navegador'];


    public function administrador(){
        return $this->belongsTo('App\Entidades\Administrador','n_idadministrador','n_id');
    } 
}

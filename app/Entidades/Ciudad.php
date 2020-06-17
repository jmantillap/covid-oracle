<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $primaryKey = 'n_id';
    const CREATED_AT = 'dt_created_at';
    const UPDATED_AT = 'dt_update_at';

    protected $fillable = ['t_nombre', 'b_habilitado'];

    public function sede()
    {
        return $this->hasMany('App\Entidades\Sedes', 'n_id');
    }
}

<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $primaryKey = 'n_idformulario';

 

    protected $fillable= ['t_nombres', 
                            'n_idusuario',
                            'n_idsede',
                            't_consentimiento',
                            't_irahoy',
                            't_sitios',
                            't_actividades',
                            't_presentadofiebre',
                            't_diasfiebre',
                            't_dolorgarganta',
                            't_malestargeneral',
                            't_secresioncongestionnasal',
                            't_dificultadrespirar', 
                            't_tosseca',
                            't_contactopersonasinfectadas',
                            'd_ultimocontacto',
                            't_realizoviaje',
                            'd_ultimoviaje',
                            't_personalsalud',
                            'n_semaforo',
                            't_activo',
                            'n_iddesactiva',
                            't_perdolfa',
                            't_molestia_diges',
                            't_sigue_aislado',                            

                        ];

                          

    protected $guarded= ['n_idformulario', 'created_at', 'updated_at'];
    //
    protected $table = 'formulario'; //Esta line se pone si la tabla se llama de manera diferente


    public function usuario() //trae los datos de usuario
	{
		 return $this->belongsTo('App\User','n_idusuario');
    }
}


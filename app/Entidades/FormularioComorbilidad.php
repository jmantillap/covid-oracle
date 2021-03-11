<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class FormularioComorbilidad extends Model
{
    protected $table = 'formulario_comorbilidad';
    protected $primaryKey = 'n_idformulario_comorbilidad'; 
    protected $fillable= ['n_idusuario','t_consentimiento','n_peso','n_talla','t_fuma','n_cigarrillos_dia','t_hipertension','t_medicamento_hipertension',
                          't_diabetes','t_medicamento_diabetes','t_corazon','t_enfermedad_corazon','t_pulmonar','t_enfermedad_pulmonar','t_medicamento_defensas_bajas',
                          't_cuales_med_defensas_bajas','t_inmunodeficiencia','t_cancer','t_quimioterapia_cancer','t_convive_mayor','t_convive_bajas_defensas',
                          't_convive_pulmonar','t_convive_cancer','t_convive_otras','t_convive_cual','t_activo','n_iddesactiva','n_semaforo','n_idactualiza'];

    protected $guarded= ['n_idformulario_cormobilidad', 'created_at', 'updated_at'];    //    
    public $incrementing = 'true';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}

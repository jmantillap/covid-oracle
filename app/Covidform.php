<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Covidform extends Model
{
    protected $primaryKey = 'n_iddocente';

    protected $fillable= ['t_nombres', 
                            't_apellidos',
                            't_idsigaa',
                            'n_idtipodocente',
                            'n_idescuela',
                            'n_idfacultad',
                            'n_yearsexperiencia',
                            'n_yearsexperienciaupb',
                            'n_idgrupoinvestigacion', 
                            'n_idcategoriainvestigador',
                            't_extensionupb',
                            't_email',
                            't_celular',
                            't_linkcvlac'
                        ];

    protected $guarded= ['n_iddocente', 'created_at', 'updated_ad'];
    //
    protected $table = 'dit_docentes'; //Esta line se pone si la tabla se llama de manera diferente
}

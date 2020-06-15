<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Vinculou extends Model
{
    protected $primaryKey = 'n_idvinculou';

    protected $fillable= ['t_vinculo'];

    protected $guarded= ['n_idescuela'];
    //
    protected $table = 'vinculou'; //Esta línea se pone si la tabla se llama de manera diferente


      

    /**
     * Get the comments for the blog post.
     */
    public function usuarios()
    {
        return $this->hasMany('App\Users','n_idvinculou');
    }

   
}

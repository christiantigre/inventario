<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CtasGrupos extends Model
{
    protected $table = 'ctas_group';

    /**
    * The database primary key value.
    *
    * @var string
    */

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cod_clase', 'clase', 'cod_grupo','grupo','cod_cuenta','cuenta','cod_subcuenta','subcuenta','cod_auxiliar','auxiliar','cod_subauxiliar','subauxiliar'];
}

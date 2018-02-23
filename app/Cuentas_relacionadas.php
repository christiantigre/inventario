<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas_relacionadas extends Model
{
    protected $table = 'cuentas_relacionadas';

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

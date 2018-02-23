<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agrupacion_sumada extends Model
{
    protected $table = 'sumas_agrupadas';

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
    protected $fillable = ['saldo_debe', 'saldo_haber', 'cod_cuenta','cuenta','periodo'];
}

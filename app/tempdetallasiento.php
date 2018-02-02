<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tempdetallasiento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tempdetallasientos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['num_asiento', 'cod_cuenta', 'cuenta', 'periodo', 'fecha', 'saldo_debe', 'saldo_haber','concepto_detalle'];

	
}

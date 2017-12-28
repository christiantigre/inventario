<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ventas';

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
    protected $fillable = ['num_venta','fecha', 'cliente', 'cel_cli', 'ruc_cli','cc_cli', 'dir_cli', 'mail_cli', 'total', 'subtotal', 'iva_cero', 'iva_calculado', 'porcentaje_iva', 'can_items', 'vendedor', 'id_cliente', 'id_personal', 'id_iva','documento'];

    
}

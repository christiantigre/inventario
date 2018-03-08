<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturacionElectronica extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facturacion_electronicas';

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
    protected $fillable = ['generar_facturas', 'obligado_contabilidad', 'path_certificado','clave_certificado', 'modo_ambiente','id_almacen'];

    
}

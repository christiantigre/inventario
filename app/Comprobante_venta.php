<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprobante_venta extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comprobante_ventas';

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
    protected $fillable = ['id_venta', 'numfactura', 'claveacceso', 'gen_xml', 'fir_xml', 'aut_xml', 'convrt_ride', 'send_ride', 'send_xml', 'num_autorizacion', 'fecha_autorizacion', 'estado_aprobacion', 'mensaje', 'id'];

    
}

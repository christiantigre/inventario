<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detallVenta extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detall_ventas';

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
    protected $fillable = ["producto", "codbarra", "precio", "cant", "total", "id_producto","id_venta"];

    public function venta()
    {
        return $this->belongsTo('App\Ventum');
    }
}

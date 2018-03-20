<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVenta extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'item_ventas';

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
    protected $fillable = ["producto", "codbarra", "precio", "cant", "total", "descuento", "id_producto"];

    public function venta()
    {
        return $this->belongsTo('App\Ventum');
    }

}

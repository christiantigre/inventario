<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['producto', 'cod_barra', 'pre_compra', 'pre_venta', 'cantidad', 'imagen', 'name_img', 'nuevo', 'promo', 'catalogo', 'activo', 'propaganda', 'id_category', 'id_subcategory', 'id_proveedor','compras','ventas','saldo','fecha_ingreso'];

    public function Category()
    {
        return $this->belongsTo('App\Category','id_category');
    }

    public function Subcategory()
    {
        return $this->belongsTo('App\Subcategory','id_subcategory');
    }

    public function Proveedor()
    {
        return $this->belongsTo('App\Proveedor','id_proveedor');
    }

}
